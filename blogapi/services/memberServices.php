<?php
namespace blogapi\services;
/**
** @ClassName: memberServices
** @Description: 用户业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\memberModels;
use hl\HLServices;
use hl\library\Functions\Jwt;
use hl\library\Functions\Password;
use hl\library\Session\HLSession;

class memberServices extends HLServices
{
    public function getMemberInfo($code)
    {
        $memberId = memberModels::getInstance()->getMemberIdByCode($code);
        $memberInfo = memberModels::getInstance()->getByWhere(
            ['id' => $memberId],
            'code,nickname,avatar,motto,home_page,github,qq,email,content'
        );
        return ['member_info' => $memberInfo];
    }

    /*
    ** 登陆
    */
    public function login($code, $pwd, &$errCode, &$errMessage, &$data)
    {
        $member = memberModels::getInstance()->getByWhere(['code' => $code], 'id,password,salt,status');
        try {
            if (empty($member)) {
                throw new \Exception('用户不存在', '-1');
            }
            if ($member['status'] == 0) {
                throw new \Exception('用户已被禁用', '-1');
            }
            if (Password::makePassword($pwd, $member['salt']) == $member['password']) {
                $jwt = new Jwt();
                $datain = ['token' => md5($code.$member['salt'].TIMESTAMP)];
                //生成token存在客户端，每次请求都要携带这个token
                $data = Jwt::getToken($datain);//生成256位的字符串
                memberModels::getInstance()->updateById($member['id'], $datain);
                HLSession::getInstance()->set($datain['token'], $member['id']);
            } else {
                throw new \Exception('密码错误', '-1');
            }
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }

    /*
    ** 退出
    */
    public function loginOut($memberId)
    {
        $member = memberModels::getInstance()->getByWhere(['id' => $memberId], 'token');
        HLSession::getInstance()->delete($member['token']);
        memberModels::getInstance()->updateById($memberId, ['token' => '']);
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
