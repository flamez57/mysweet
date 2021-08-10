<?php
namespace zhangapi\controllers;

use zhangapi\services\memberServices;
use hl\library\Tools\HLResponse;
use zhangapi\services\bookServices;

/**
** @ClassName: ManageController
** @Description: 管理控制器必须是登陆状态下
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/

class ManageController extends BaseController
{
    /*
    ** 今日账单 http://mysweet.com/index.php?m=zhangapi&c=manage&a=getTodayList
    */
    public function getTodayListAction()
    {
        $this->data = bookServices::getInstance()->getTodayList($this->bookId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 详情 http://mysweet.com/index.php?m=zhangapi&c=manage&a=getDetail
    */
    public function getDetailAction()
    {
        $id = $this->getQuery('id', '');
        $this->data = bookServices::getInstance()->getDetail($id, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 保存  http://mysweet.com/index.php?m=zhangapi&c=manage&a=save
    */
    public function saveAction()
    {
        $id = $this->getPost('id', 0);
        if ($id == 0) {
            $param['account_book_id'] = $this->bookId;
            $param['year'] = date('Y');
            $param['month'] = date('m');
            $param['day'] = date('d');
            $param['created_at'] = TIMESTAMP;
            $param['sex'] = $this->sex;
            $param['member_id'] = $this->memberId;
        }
        $param['title'] = $this->getPost('title', '');
        $param['status'] = $this->getPost('status', '0');
        $param['type'] = $this->getPost('type', '0');
        $param['obj'] = $this->getPost('obj', '0');
        $param['money'] = $this->getPost('money', '0');
        $param['content'] = $this->getPost('content', '');
        $this->data = bookServices::getInstance()->save($param, $id);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //统计   http://mysweet.com/index.php?m=zhangapi&c=manage&a=collect
    public function collectAction()
    {
        $year = $this->getQuery('year', date('Y'));
        $month = $this->getQuery('month', date('m'));
        $this->data = bookServices::getInstance()->getAllList($this->bookId, $year, $month);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //类型选项 http://mysweet.com/index.php?m=zhangapi&c=manage&a=typeList
    public function typeListAction()
    {
        $this->data = bookServices::getInstance()->typeList();
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //对象选项 http://mysweet.com/index.php?m=zhangapi&c=manage&a=objList
    public function objListAction()
    {
        $this->data = bookServices::getInstance()->objList();
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //年月下拉选项 http://mysweet.com/index.php?m=zhangapi&c=manage&a=yearMonth
    public function yearMonthAction()
    {
        $this->data = bookServices::getInstance()->yearMonth();
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //待审核消息
    public function messageAction()
    {
        $this->data = bookServices::getInstance()->messageList($this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //改手机号
    public function setMobileAction()
    {
        $mobile = $this->getPost('mobile', '');
        memberServices::getInstance()->setMobile($mobile, $this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //改密码
    public function setPwdAction()
    {
        $pwd = $this->getPost('pwd', '');
        memberServices::getInstance()->setPwd($pwd, $this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //改性别
    public function setSexAction()
    {
        memberServices::getInstance()->setSex($this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //移除
    public function moveAction()
    {
        $self = $this->getPost('self', 0);
        memberServices::getInstance()->move($self, $this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //邀请
    //加入

    //审核消息
    public function checkMsgAction()
    {
        $id = $this->getPost('id', 0);
        $status = $this->getPost('status', 0);
        memberServices::getInstance()->checkMsg($id, $status, $this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 退出
    */
    public function loginOutAction()
    {
        $this->data = memberServices::getInstance()->loginOut($this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }
}
