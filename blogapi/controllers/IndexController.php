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
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/

class IndexController extends BaseController
{
    /*
    ** 分类 http://mysweet.com/index.php?m=blogapi&c=index&a=cateList&code=123
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
     * 回复
     */
    /*
    ** 档案
    */
    public function diaryAction()
    {
        $code = $this->getQuery('code', '');
        $this -> data = diaryServices::getInstance()->getFrontList($code);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    //执行安装
    public function installDoAction()
    {
        $host = $this->getPost('host', 'localhost');
        $dbname = $this->getPost('dbname', 'mysweet');
        $username = $this->getPost('username', 'root');
        $password = $this->getPost('password', 'vagrant');
        $adminName = $this->getPost('adminm', 'admin');
        $adminPwd = $this->getPost('adminp', 'admin');
        $adminPwd2 = $this->getPost('adminpt', 'admin');
        //链接数据库
        installServices::getInstance()->wdbConfig($host, $username, $password, '');
        //建表插入基础数据
        installServices::getInstance()->createTableAndInsertData($dbname, 'default');
        //链接数据库
        installServices::getInstance()->wdbConfig($host, $username, $password, $dbname);
        //创建管理员账号
        installServices::getInstance()->createAdmin($adminName, $adminPwd, $adminPwd2);
    }
}
