<?php
namespace blogapi\controllers;

use blogapi\services\commentServices;
use blogapi\services\memberServices;
use blogapi\services\cateServices;
use blogapi\services\tagServices;
use blogapi\services\articleServices;
use blogapi\services\diaryServices;
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
     * 个人信息详情编辑用
     */
    /*
     * 个人信息编辑保存
     */
    /*
     * 修改密码保存
     */
    /*
    ** 分类 http://mysweet.com/index.php?m=blogapi&c=manage&a=cateList&code=123
    */
    public function cateListAction()
    {
        $code = $this->getQuery('code', '');
        $this -> data = cateServices::getInstance()->getFrontCateList($code);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 标签 http://mysweet.com/index.php?m=blogapi&c=index&a=tagList&code=123
    */
    public function tagListAction()
    {
        $code = $this->getQuery('code', '');
        $this -> data = tagServices::getInstance()->getFrontTagList($code);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 文章列表 http://mysweet.com/index.php?m=blogapi&c=index&a=articleList&code=123
    */
    public function articleListAction()
    {
        $param['code'] = $this->getQuery('code', '');
        $param['page'] = $this->getQuery('page', 1);
        $param['page_size'] = $this->getQuery('page_size', 20);
        $param['tag_id'] = $this->getQuery('tag_id', 0);
        $param['cate_id'] = $this->getQuery('cate_id', 0);
        $param['keyword'] = $this->getQuery('keyword', '');
        $this -> data = articleServices::getInstance()->getFrontArticleList($param);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 用户信息 http://mysweet.com/index.php?m=blogapi&c=index&a=memberInfo&code=123
    */
    public function memberInfoAction()
    {
        $code = $this->getQuery('code', '');
        $this -> data = memberServices::getInstance()->getMemberInfo($code);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 详情 http://mysweet.com/index.php?m=blogapi&c=index&a=articleDetail&id=1
    */
    public function articleDetailAction()
    {
        $id = $this->getQuery('id', 0);
        $this -> data = articleServices::getInstance()->getFrontArticleDetail($id, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 发表看法
    */
    public function addCommentAction()
    {
        $articleId = $this->getPost('article_id', 0);
        $content = $this->getPost('content', '');
        $nickname = $this->getPost('nickname', '佚名');
        $this -> data = commentServices::getInstance()->addComment($articleId, $content, $nickname);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 回复
    */
    public function replyAction()
    {
        $id = $this->getPost('id', 0);
        $content = $this->getPost('content', '');
        $this -> data = commentServices::getInstance()->reply($id, $content, $this->memberId);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 档案
    */
    public function diaryAction()
    {
        $code = $this->getQuery('code', '');
        $this -> data = diaryServices::getInstance()->getFrontList($code);
        HLResponse::json($this->code, $this->message, $this->data);
    }
}
