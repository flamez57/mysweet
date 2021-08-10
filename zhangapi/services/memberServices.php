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
use Yaf\Exception;
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
            if (empty($pwd)) {
                $pwd = '888888';
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

    //改手机号
    public function setMobile($mobile, $memberId, &$errCode, &$errMessage)
    {
        try {
            $member = accountBookMemberModels::getInstance()->getByWhere(
                ['mobile' => $mobile],
                'id'
            );
            if ($memberId != $member['id']) {
                throw new \Exception('手机号已被使用过', '-1');
            }
            accountBookMemberModels::getInstance()->updateById($memberId, ['mobile' => $mobile]);
            $errMessage = '修改成功';
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }

    //修改密码
    public function setPwd($pwd, $memberId, &$errCode, &$errMessage)
    {
        try {
            $member = accountBookMemberModels::getInstance()->getByWhere(['id' => $memberId], 'id');
            if (empty($member)) {
                throw new \Exception('用户不存在', '-1');
            }

            $data['salt'] = Password::makeSalt();
            $data['password'] = Password::makePassword($pwd, $data['salt']);
            accountBookMemberModels::getInstance()->updateById($memberId, $data);
            $errMessage = '修改成功';
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }

    //申请改性别
    public function setSex($memberId, &$code, &$message)
    {
         $member = accountBookMemberModels::getInstance()->getByWhere(
            ['id' => $memberId],
            'id,account_book_id,sex'
        );
        //查询另一半
        $member['sex'] ^= 1;
        $otherMember = accountBookMemberModels::getInstance()->getByWhere(
            $member,
            'id,mobile'
        );
        if (empty($otherMember)) { //不存在另一半直接改
            accountBookMemberModels::getInstance()->updateById($memberId, $member);
            $code = '1';
            $message = '更改成功';
        } else {
            $data['type'] = accountBookMsgModels::TYPE_1;
            $data['send_member_id'] = $member['id'];
            $data['created_at'] = TIMESTAMP;
            $data['accept_member_id'] = $otherMember['id'] ?? 1;
            $data['accept_mobile'] = $otherMember['mobile'] ?? '17758023364';
            accountBookMsgModels::getInstance()->insert($data);
            $code = '1';
            $message = '等待审核通过就可以更改性别';
        }
    }

    /*
        self::TYPE_2 => '对方请求退出账单',
        self::TYPE_3 => '对方请求将您移出账单',
        self::TYPE_4 => '对方请求加入您得账单',
        self::TYPE_5 => '对方邀请您得账单（放弃自己账单加入）',
        self::TYPE_6 => '您还没有关联账单是否创建新账单',*/
    public function checkMsg($id, $status, $memberId, &$errCode, &$errMessage)
    {
        try {
            $msg = accountBookMsgModels::getInstance()->getByWhere(['id' => $id], 'id,type,accept_member_id,send_member_id,accept_mobile');
            $member = accountBookMemberModels::getInstance()->getByWhere(
                ['id' => $memberId],
                'id,mobile,sex'
            );
            if (empty($msg)) {
                throw new \Exception('用户不存在', '-1');
            }
            if ($msg['accept_member_id'] != $memberId && $msg['accept_mobile'] != $member['mobile']) {
                throw new \Exception('用户不存在', '-1');
            }
            if ($status == 0) { // 拒绝
                accountBookMemberModels::getInstance()->delById($id);
            } elseif ($status == 1) { //同意
                switch ($msg['type']) {
                    case accountBookMsgModels::TYPE_1:
                        accountBookMemberModels::getInstance()->updateById($msg['send_member_id'], ['sex' => $member['sex']]);
                        $member['sex'] ^= 1;
                        accountBookMemberModels::getInstance()->updateById($memberId, ['sex' => $member['sex']]);
                        $errMessage = '修改成功';
                        break;
                    case accountBookMsgModels::TYPE_7:
                        $data['salt'] = Password::makeSalt();
                        $data['password'] = Password::makePassword('888888', $data['salt']);
                        accountBookMemberModels::getInstance()->updateById($msg['send_member_id'], $data);
                        $errMessage = '初始化成功';
                        break;
                }
            }
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }
}
