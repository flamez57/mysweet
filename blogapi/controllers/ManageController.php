<?php
namespace blogapi\controllers;

use blogapi\services\articleServices;
use blogapi\services\cateServices;
use blogapi\services\diaryServices;
use blogapi\services\memberServices;
use hl\library\Tools\HLResponse;
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
    ** 个人信息详情编辑用  http://mysweet.com/index.php?m=blogapi&c=manage&a=memberInfoForEdit
    */
    public function memberInfoForEditAction()
    {
        $this->data = memberServices::getInstance()->memberInfoForEdit($this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 个人信息编辑保存
    */
    public function saveMemberInfoAction()
    {
        $param['nickname'] = $this->getPost('nickname', '');
        $param['avatar'] = $this->getPost('avatar', '');
        $param['motto'] = $this->getPost('motto', '');
        $param['home_page'] = $this->getPost('home_page', '');
        $param['github'] = $this->getPost('github', '');
        $param['qq'] = $this->getPost('qq', '');
        $param['email'] = $this->getPost('email', '');
        $param['content'] = $this->getPost('content', '');
        memberServices::getInstance()->saveMemberInfo($param, $this->memberId);
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
    ** 文章保存
    */
    public function saveAction()
    {
        $id = $this->getPost('id', 0);
        $param['cate_id'] = $this->getPost('cate_id', 0);
        $param['title'] = $this->getPost('title', '');
        $param['drafts_content'] = $this->getPost('content', '');
        $param['status'] = $this->getPost('status', 0);
        $param['tags'] = $this->getPost('tags', []);
        $this->data = articleServices::getInstance()->articleSave($id, $param, $this->memberId);
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
