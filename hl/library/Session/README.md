    /**
     * 写入登入信息
     * @param $supplier
     * @param $hashToken
     * @param $hashPwd
     * @return array|null
     */
    private function operateLoginInfo($supplier, $hashToken, $hashPwd)
    {
        if (count($supplier) <= 0) {
            return null;
        }

        $ip = Helper::getIp();
        $supplierInfo = [
            'supplierId' => $supplier['id'],
            'account' => $supplier['account'],
            'store_id' => $supplier['store_id'],
            'store_type' => $supplier['store_type'],
        ];

        //写入登入信息
        $time = defined(TIMESTAMP) ? TIMESTAMP : time();
        $data = [];
        $expire = $time + SlSessionConfig::getSlSellerSessionConfig()['tokenExpire'];
        //写入session
        $sessionVal = $this->encodeSession(
            $supplierInfo,
            $hashToken,
            $expire,
            $hashPwd,
            $ip
        );

        //session设置
        SlSession::getInstance(SlSessionConfig::getSlSellerSessionConfig())->init($hashToken)
            ->set(SlSessionConfig::$SL_SELLER_SESSION_NAME, $sessionVal)
            ->save();

        //更新数据库中的数据, 设置refreshToken 过期时间
        $cookieExpire = $time + SlSessionConfig::$SL_SELLER_HASH_TOKEN_EXPIRE;
        if (Helper::isBetaEnv()) {
            $cookieExpire += 30 * 86400;
        }
        $cookieDomain = CommonConfig::getCookieDomain();
        $cookieSecure = SlSessionConfig::getSlAdminSessionConfig()['tokenCookieSecure'];
        $cookieHttpOnly = SlSessionConfig::getSlAdminSessionConfig()['tokenCookieHttpOnly'];

        //写入cookie
        setcookie("hashToken", $hashToken, $cookieExpire, "/", $cookieDomain, $cookieSecure, $cookieHttpOnly);
        setcookie("uid", $supplier['id'], $cookieExpire, "/", $cookieDomain);
        setcookie("username", $supplier['account'], $cookieExpire, "/", $cookieDomain);
        setcookie("store_id", $supplier['store_id'], $cookieExpire, "/", $cookieDomain);
        setcookie("store_type", $supplier['store_type'], $cookieExpire, "/", $cookieDomain);
        $headPortrait =
            $supplier['head_portrait'] ?? 'https://static.sldlcdn.com/v2/front/static/res/1904_message/default.png';
        setcookie("head_portrait", Helper::fullUrlPic($headPortrait), $cookieExpire, "/", $cookieDomain);
        $updateData = [
            'token' => $hashToken,
            'expire' => $cookieExpire,
            'last_login_time' => $time,
        ];
        $affectedRows = $this->supplierDao->updateById($supplier['id'], $updateData);
        if (!$affectedRows) {
            return $data;
        }
        $data['hashToken'] = $hashToken;
        $data['head_portrait'] = $headPortrait;
        $data['expire'] = $expire;
        $data['uid'] = $supplier['id'];
        $data['username'] = $supplier['account'];
        $data['store_id'] = $supplier['store_id'];
        $data['store_type'] = $supplier['store_type'];
        return $data;
    }

    /**
     * 校验登入的参数
     * @param $username
     * @param $password
     * @return Result
     */
    public function verifyLoginParams($username, $password, $vcode)
    {
        $result = new Result();
        if (empty($username) || empty($password)) {
            $result->code = SellerCode::PASSWORD_EMPTY;
            $result->message = '用户名或密码不能为空';
            return $result;
        }
        $sessionObj = SlSession::getInstance(SlSessionConfig::getSlCodeSessionConfig())->init('');
        $verifyCode = $sessionObj->get(SlSessionConfig::$SL_CODE_SESSION_NAME);

        if (!Helper::isBetaEnv()) {
            if (empty($vcode)) {
                $result->message = '验证码不能为空';
                return $result;
            }
            if ($verifyCode !== md5(strtolower($vcode))) {//需要严格判断，避免md5 后 0e 弱类型判断漏洞
                //清除验证码session
                $sessionObj->delete(SlSessionConfig::$SL_CODE_SESSION_NAME)->save();
                $result->message = '验证码错误';
                return $result;
            }
            //清除验证码session
            $sessionObj->delete(SlSessionConfig::$SL_CODE_SESSION_NAME)->save();
        }
//        if (strlen($username) < 3 || strlen($username) > 16) {
//            $result->code = SellerCode::USERNAME_BAD;
//            $result->message = '用户名必须是3到16个字符';
//            return $result;
//        }
//        if (strlen($password) < 6 || strlen($password) > 16) {
//            $result->code = SellerCode::PASSWORD_BAD;
//            $result->message = '密码必须是6到16个字符';
//            return $result;
//        }

        $result->success = true;
        $result->message = '参数校验通过';
        return $result;
    }

    /**
     * 判断用户是否登入
     * @param $cookieToken
     * @return Result
     */
    public function isLogin($cookieToken)
    {
        $result = new Result();
        if (empty($cookieToken)) {
            $result->message = '会话失效，请重新登录';
            return $result;
        }

        $sessionArr = SlSession::getInstance(SlSessionConfig::getSlSellerSessionConfig())->init($cookieToken)
            ->get(SlSessionConfig::$SL_SELLER_SESSION_NAME);
        $sessionArr = $this->decodeSession($sessionArr);
        $uid = $sessionArr['uid'];
        $expire = $sessionArr['expire'];
        $hashToken = $sessionArr['hashToken'];
        $hashPwd = $sessionArr['hashPwd'];
        $ip = $sessionArr['ip'];

        if (!empty($hashToken) && $cookieToken != $hashToken) {
            $result->message = 'token被篡改了';
            return $result;
        }

        $supplier = $this->supplierDao->getByWhere(['token' => $cookieToken, 'is_delete' => 0]);

        if (empty($supplier)) {
            $result->message = '帐号已经在其它设备登录';
            return $result;
        }
        //如果token不在有效期内
        if (TIMESTAMP > $supplier['expire']) {
            $result->message = '会话过期，请重新登入';
            return $result;
        }

        if (!empty($uid)) {
            //判断密码是否有变动
            if ($this->getHashPwd($supplier['password']) != $hashPwd) {
                $result->message = '账号已经修改密码，请重新登陆';
                return $result;
            }
            //判断ip是否变动
            if (Helper::getIp() != $ip) {
                $result->message = '登陆ip有变动，请重新登陆';
                return $result;
            }
        }

        if (empty($uid) || TIMESTAMP > $expire) {
            //更新登录信息
            $this->operateLoginInfo(
                $supplier,
                $cookieToken,
                $this->getHashPwd($supplier['password'])
            );
        }

        $result->success = true;
        $result->message = 'login ok';
        return $result;
    }

    public function encodeSession($supplier, $hashToken, $expire, $hashPwd, $ip)
    {
        $sessionVal = sprintf(
            "%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s",
            $supplier['supplierId'],
            $supplier['account'],
            $hashToken,
            $expire,
            $hashPwd,
            $ip,
            $supplier['store_id'],
            $supplier['store_type']
        );
        return $sessionVal;
    }

    public function decodeSession($sessionString)
    {
        $arr = explode("\t", $sessionString);

        $uid = isset($arr[0]) ? $arr[0] : '';
        $username = isset($arr[1]) ? $arr[1] : '';
        $hashToken = isset($arr[2]) ? $arr[2] : '';
        $expire = isset($arr[3]) ? $arr[3] : '';
        $hashPwd = isset($arr[4]) ? $arr[4] : '';
        $ip = isset($arr[5]) ? $arr[5] : '';
        $store_id = isset($arr[6]) ? $arr[6] : '';
        $store_type = isset($arr[7]) ? $arr[7] : '';

        return compact('uid', 'username', 'hashToken', 'expire', 'hashPwd', 'ip', 'store_id', 'store_type');
    }

    /**
     * 退出
     * @param $uid
     * @return bool
     */
    public function loginOut($supplierId)
    {
        if (!empty($supplierId)) {

            $this->supplierDao->updateById($supplierId, ['token' => '']);
        }

        SlSession::getInstance(SlSessionConfig::getSlSellerSessionConfig())->init('')
            ->delete(SlSessionConfig::$SL_SELLER_SESSION_NAME)->save();

        $cookieDomain = CommonConfig::getCookieDomain();

        setcookie("hashToken", '', -1, "/", $cookieDomain);
        setcookie("uid", '', -1, "/", $cookieDomain);
        setcookie("username", '', -1, "/", $cookieDomain);
        if ($supplierId) {
            $redisObj = RedisDb::getInstance(RedisCode::SELLER_LOGIN_NODE_PREFIX);
            $redisObj->delete($supplierId);
        }
        return true;
    }

    /**
     * 获取登入之后的信息
     * @param $cookieToken
     * @return Result
     */
    public function getLoginInfo($cookieToken)
    {
        $result = new Result();
        $isLogin = $this->isLogin($cookieToken);
        if (!$isLogin->success) {
            $result->message = $isLogin->message;
            return $result;
        }

        $data = SlSession::getInstance(SlSessionConfig::getSlSellerSessionConfig())->init($cookieToken)
            ->get(SlSessionConfig::$SL_SELLER_SESSION_NAME);
        $data = $this->decodeSession($data);

        $result->success = true;
        $result->message = 'ok';
        $result->data = $data;

        return $result;
    }
