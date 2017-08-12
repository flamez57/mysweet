<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 20:12
 * Author: Flamez57 <1050355217@qq.com>
 */
class IndexController extends Controller{
	public function Index()
	{
		echo 'hello world';
		$articles = new ArticleModel;
//        var_dump($articles);

        $a = $articles->order('id', false)->page(5,3)->findAll();
echo $articles->lastSql;
        var_dump($a);
	}
	public function Test()
	{
		/*$mUF = new User_Finance;
$mUF->fRow(1);
$mUF->insert(array('uid'=>1, 'money'=>9999));
$mUF->update(array('uid'=>1, 'money'=>9));

//数据库实例类(继承 Db_Mysql)的一些操作方法。

# 联表查询
$mArticle = new ArticleModel();
$mArticle->join('category c', 'c.id=cid', 'LEFT')->fList();

# SQL执行 - 返回:bool
$mArticle->exec('DELETE FROM user');

# 插入 - 返回:id
$mArticle->insert(array('name'=>'张洋', 'email'=>'2050479@qq.com'));

# 更新 - 返回:bool
$mArticle->update(array('id' => 1, 'name' => '张洋'));
# 等同于 :
$mArticle->where('id=1')->update(array('name' => '张洋'));

# 删除
$mArticle->where('created=0')->del();
$mArticle->del(1,2,3);
$mArticle->del('status=1');

# 列表
$mArticle->where("id>0")->field('id,name,email')->limit('0,2')->order('id desc')->fList();
$mArticle->fList('13,14,15');
$mArticle->fList(array('where'=>"name='张洋'", 'limit'=>'0,2', 'order'=>'id desc', 'field'=>'id,name'));

# 查询单条，条件 name='张洋'
$mArticle->ffName('张洋');
$mArticle->where("name='张洋'")->fRow();

# 查询单条，条件 id=15
$mArticle->fRow(15);

# 查询某字段，返回字符串
$mArticle->fOne('count(*)');

# 查询哈西列表
$mArticle->fHash('id,name'); # array(1=>张洋, 2=>PHP)
$mArticle->fHash('id,name,email'); # array(1=>array(id=>1,name=>张洋,email=>'2050479 at qq.com'), 2=>array())

# 事务
$mArticle->begin();
$mArticle->insert(..);
$mArticle->commit();*/
	}
}
