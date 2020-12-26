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
            if (md5($pwd.$member['salt']) == $member['password']) {
                $data = ['token' => ''];
                //记录token
            } else {
                throw new \Exception('密码错误', '-1');
            }
        } catch (\Exception $ex) {
            $errCode = $ex->getCode();
            $errMessage = $ex->getMessage();
        }
    }
}
