<?php
namespace zhangapi\services;
/**
** @ClassName: memberServices
** @Description: 用户业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\memberModels;
use hl\HLServices;
use hl\library\Functions\Password;
use hl\library\Session\HLSession;
use zhangapi\models\accountBookMemberModels;
use zhangapi\models\accountBookMsgModels;

class memberServices extends HLServices
{
    //注册
    public function register($params, &$errCode, &$errMessage, &$data)
    {
        try {
            $member = accountBookMemberModels::getInstance()->getByWhere(['mobile' => $params['mobile']], 'id');
            if (!empty($member)) {
                throw new \Exception('用户已经存在', '-1');
            }
            $data['mobile'] = $params['mobile'];
            $data['sex'] = $params['sex'];
            $data['salt'] = Password::makeSalt();
            $data['password'] = Password::makePassword($params['pwd'], $data['salt']);
            $memberId = accountBookMemberModels::getInstance()->insert($data);
            //注册成功然后登录
            $token = md5($params['mobile'].$member['salt'].TIMESTAMP);
            //存入cookie
            $session = HLSession::getInstance(self::$config['token']['zhangapi'])->init();
            $session->set('member_id', $member['id']);
            $session->set('token', $token);
            $session->save();
            $data = [
                'mobile' => $params['mobile'],
                'token' => $session->getToken(),
            ];
            $errCode = '1';
            $errMessage = '注册成功';
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }

    // 登陆
    public function login($mobile, $pwd, &$errCode, &$errMessage, &$data)
    {
        $member = accountBookMemberModels::getInstance()->getByWhere(
            ['mobile' => $mobile],
            'id,mobile,password,salt'
        );
        try {
            if (empty($member)) {
                throw new \Exception('用户不存在', '-1');
            }
            if (Password::makePassword($pwd, $member['salt']) == $member['password']) {
                $token = md5($mobile.$member['salt'].TIMESTAMP);
                //存入cookie
                $session = HLSession::getInstance(self::$config['token']['zhangapi'])->init();
                $session->set('member_id', $member['id']);
                $session->set('token', $token);
                $session->save();
                $data = [
                    'mobile' => $mobile,
                    'token' => $session->getToken(),
                ];
            } else {
                throw new \Exception('密码错误', '-1');
            }
            $errCode = '1';
            $errMessage = '登录成功';
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }

    // 忘记密码
    public function forget($mobile, &$errCode, &$errMessage, &$data)
    {
        $member = accountBookMemberModels::getInstance()->getByWhere(
            ['mobile' => $mobile],
            'id,account_book_id,sex'
        );
        //查询另一半
        $member['sex'] ^= 1;
        $otherMember = accountBookMemberModels::getInstance()->getByWhere(
            $member,
            'id,mobile'
        );
        $data['type'] = accountBookMsgModels::TYPE_7;
        $data['send_member_id'] = $member['id'];
        $data['created_at'] = TIMESTAMP;
        $data['accept_member_id'] = $otherMember['id'] ?? 1;
        $data['accept_mobile'] = $otherMember['mobile'] ?? '17758023364';
        accountBookMsgModels::getInstance()->insert($data);
        $errCode = '1';
        $errMessage = '等待审核通过就可以免密码登录，登录后及时设置密码';
    }

    // 退出
    public function loginOut()
    {
        //销毁session
        HLSession::getInstance(self::$config['token']['zhangapi'])->init()->destroy();
        return new \stdClass();
    }

    /*
    ** 编辑用用户信息
    */
    public function memberInfoForEdit($memberId)
    {
        $memberInfo = memberModels::getInstance()->getByWhere(
            ['id' => $memberId],
            'code,nickname,avatar,motto,home_page,github,qq,email,content'
        );
        return ['member_info' => $memberInfo];
    }

    /*
    ** 修改信息
    */
    public function saveMemberInfo($param, $memberId)
    {
        $data = [
            'nickname' => $param['nickname'],
            'avatar' => $param['avatar'],
            'motto' => $param['motto'],
            'home_page' => $param['home_page'],
            'github' => $param['github'],
            'qq' => $param['qq'],
            'email' => $param['email'],
            'content' => $param['content'],
        ];
        memberModels::getInstance()->updateById($memberId, $data);
    }

    /*
    ** 修改密码
    */
    public function setPwd($pwd, $pwdnew, $memberId, &$errCode, &$errMessage, &$data)
    {
        try {
            $member = memberModels::getInstance()->getByWhere(['id' => $memberId], 'id,password,salt,status');
            if (empty($member)) {
                throw new \Exception('用户不存在', '-1');
            }
            if ($member['status'] == 0) {
                throw new \Exception('用户已被禁用', '-1');
            }
            if (Password::makePassword($pwd, $member['salt']) != $member['password']) {
                throw new \Exception('原密码错误', '-1');
            }

            $data['salt'] = Password::makeSalt();
            $data['password'] = Password::makePassword($pwdnew, $data['salt']);
            memberModels::getInstance()->updateById($memberId, $data);
            $errMessage = '修改成功';
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }
}
