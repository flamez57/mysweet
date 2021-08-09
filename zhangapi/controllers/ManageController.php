<?php
namespace zhangapi\controllers;

use blogapi\services\articleServices;
use blogapi\services\cateServices;
use blogapi\services\diaryServices;
use blogapi\services\memberServices;
use blogapi\services\tagServices;
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

    /*
    ** 修改密码保存
    */
    public function setPwdAction()
    {
        $pwd = $this->getPost('pwd', '');
        $pwdnew = $this->getPost('pwd_new', '');
        $pwdnew2 = $this->getPost('pwd_new2', '');
        if ($pwdnew == $pwdnew2) {
            memberServices::getInstance()->setPwd($pwd, $pwdnew, $this->memberId, $this->code, $this->message, $this->data);
        } else {
            $this->code = -1;
            $this->message = '两次输入的密码不一致';
        }
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 图片上传
    */
    public function uploadImgAction()
    {
        $y = date('Y');
        $m = date('m');
        $d = date('d');
        $path = "./upload/{$y}/{$m}/{$d}/";
        $upload = new \hl\library\Tools\Files\HLUploadFile($path, 'jpg,jpeg,png,gif,pdf');
        if ($upload->upload('img')) {
            $this->data['path'] = trim($path, '.');
            //上传后的文件信息 name size type
            $this->data['info'] = $upload->getFileInfo();
            //上传后的文件名
            $this->data['name'] = $upload->getFileName();
            $this->data['domain'] = self::$config['common']['domain'];
            $this->data['full_path'] = $this->data['domain'].$this->data['path'].$this->data['name'];
        } else {
            //失败的错误信息
            $this->code = -1;
            $this->message = $upload->getErrorMsg();
        }
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 文章列表
    */
    public function articleListAction()
    {
        $keyword = $this->getQuery('keyword', '');
        $page = $this->getQuery('page', 1);
        $pageSize = $this->getQuery('page_size', 20);
        $type = $this->getQuery('type', 0); //0全部  1草稿  2发布  3回收站
        $this->data = articleServices::getInstance()->articleList($page, $pageSize, $keyword, $type, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 文章详情
    */
    public function detailAction()
    {
        $id = $this->getQuery('id', 0);
        $this->data = articleServices::getInstance()->articleDetail($id, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 删除文章
    */
    public function delArticleAction()
    {
        $id = $this->getPost('id', 0);
        $this->data = articleServices::getInstance()->delArticle($id, $this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 发布退回文章
    */
    public function updateStatusAction()
    {
        $id = $this->getPost('id', 0);
        $status = $this->getPost('status', 0);
        $this->data = articleServices::getInstance()->updateStatus($id, $status, $this->memberId, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 分类下拉
    */
    public function cateSelectAction()
    {
        $this->data = cateServices::getInstance()->cateSelect();
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 标签下拉
    */
    public function tagSelectAction()
    {
        $this->data = tagServices::getInstance()->tagSelect();
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 分类列表
    */
    public function cateListAction()
    {
        $page = $this->getQuery('page', 1);
        $pageSize = $this->getQuery('page_size', 20);
        $this->data = cateServices::getInstance()->cateList($page, $pageSize, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 分类详情
    */
    public function cateDetailAction()
    {
        $id = $this->getQuery('id', 0);
        $this->data = cateServices::getInstance()->cateDetail($id);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 分类保存
    */
    public function saveCateAction()
    {
        $id = $this->getPost('id', 0);
        $param['name'] = $this->getPost('name', '');
        $param['sort'] = $this->getPost('sort', 0);
        $param['status'] = $this->getPost('status', 1);
        $this->data = cateServices::getInstance()->saveCate($id, $param, $this->code, $this->message);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 日记列表
    */
    public function diaryListAction()
    {
        $page = $this->getQuery('page', 1);
        $pageSize = $this->getQuery('page_size', 20);
        $param['year'] = $this->getQuery('year', date('Y'));
        $param['mon'] = $this->getQuery('mon', '');
        $param['day'] = $this->getQuery('day', '');
        $this->data = diaryServices::getInstance()->diaryList($page, $pageSize, $param, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 日记保存
    */
    public function addDiaryAction()
    {
        $content = $this->getPost('content', '');
        $this->data = diaryServices::getInstance()->addDiary($content, $this->memberId);
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
