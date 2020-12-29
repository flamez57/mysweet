<?php
namespace blogapi\controllers;

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
        $path = './upload/';
        $upload = new \hl\library\Tools\Files\HLUploadFile($path, 'jpg,jpeg,png,gif,pdf');
        if ($upload->upload('img')) {
            $this->data['path'] = $path;
            //上传后的文件信息 name size type
            $this->data['info'] = $upload->getFileInfo();
            //上传后的文件名
            $this->data['name'] = $upload->getFileName();
        } else {
            //失败的错误信息
            $this->code = -1;
            $this->message = $upload->getErrorMsg();
        }
        HLResponse::json($this->code, $this->message, $this->data);
    }
    /*
     * 文章列表
     */
    /*
     * 文章详情
     */
    /*
     * 文章保存
     */
    /*
     * 删除文章
     */
    /*
     * 发布退回文章
     */
    /*
     * 分类下拉
     */
    /*
     * 分类列表
     */
    /*
     * 分类详情
     */
    /*
     * 分类保存
     */
    /*
     * 日记列表
     */
    /*
     * 日记保存
     */
}
