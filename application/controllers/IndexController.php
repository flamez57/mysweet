<?php
namespace application\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use application\models\installModels;
use application\models\exampleModels;
use hl\HLController;
use application\services\exampleServices;
use application\services\installServices;

class IndexController extends HLController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        //框架欢迎页
    }

    //安装
    public function installAction()
    {
        //显示安装页面
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

    public function testAction()
    {
        $p2 = [];
        $p3 = [];
        $p4 = [];
        $p5 = [];
        $w2 = [];
        $w3 = [];
        $w4 = [];
        $w5 = [];
        $sp2 = [];
        $sp3 = [];
        $sp4 = [];
        $sp5 = [];
        $sw2 = [];
        $sw3 = [];
        $sw4 = [];
        $sw5 = [];
        $sql = "select id,supplier_goods_id,supplier_store_id,goods_id,title,shipping from srm_goods where is_delete = 0 and goods_id >0";
        $list = exampleModels::getInstance()->aa($sql);
        $data = [];
        foreach ($list as $_list) {
            if (empty($_list['shipping'])) {
                continue;
            }
            $ship = json_decode($_list['shipping'], true);
            if (!isset($ship['postage_default']) || !isset($ship['district'])) {
                continue;
            }
            //var_dump($ship, $_list);
            if ($ship['type'] == 'pcs') {
                if (!empty($ship['district'])) {
                    foreach ($ship['district'] as $_v) {
                        if ($_v['postage'] >= 20) {
                            $data[] = [
                                '供应链商品id' => $_list['supplier_goods_id']."\t",
                                '商品id' => $_list['goods_id'],
                                '商品名称' => $_list['title'],
                                '件数' => $_v['start'],
                                '钱' => $_v['postage'],
                                '区域' => $_v['to_province'],
                                '首重' => '',
                                '区域2' => '',
                                '钱2' => '',
                            ];
                        }
                    }
                }
            } elseif ($shop['type'] = 'weight') {
                if (!empty($ship['district'])) {
                    foreach ($ship['district'] as $_v) {
                        if ($_v['postage'] >= 20) {
                            $data[] = [
                                '供应链商品id' => $_list['supplier_goods_id']."\t",
                                '商品id' => $_list['goods_id'],
                                '商品名称' => $_list['title'],
                                '件数' => '',
                                '区域' => '',
                                '钱' => '',
                                '首重' => $_v['start'],
                                '区域2' => $_v['to_province'],
                                '钱2' => $_v['postage'],
                            ];
                        }
                    }
                }
            }
            //var_dump($ship);
        }
        //var_dump($data);
        die;
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('202091');
        //设置表头
        $csv->setTableHead(['code', 'zi_gou', 'title', 'pcs','fee', 'zero', 'weg','fee', 'zero']);
        //导出数据
        $csv->putout($data);
        /*
        echo "p2== ".count(array_unique($p2))."<br>";
        echo "p3== ".count(array_unique($p3))."<br>";
        echo "p4== ".count(array_unique($p4))."<br>";
        echo "p5== ".count(array_unique($p5))."<br>";
        echo "w2== ".count(array_unique($w2))."<br>";
        echo "w3== ".count(array_unique($w3))."<br>";
        echo "w4== ".count(array_unique($w4))."<br>";
        echo "w5== ".count(array_unique($w5))."<br>";
        echo "sp2== ".count(array_unique($sp2))."<br>";
        echo "sp3== ".count(array_unique($sp3))."<br>";
        echo "sp4== ".count(array_unique($sp4))."<br>";
        echo "sp5== ".count(array_unique($sp5))."<br>";
        echo "sw2== ".count(array_unique($sw2))."<br>";
        echo "sw3== ".count(array_unique($sw3))."<br>";
        echo "sw4== ".count(array_unique($sw4))."<br>";
        echo "sw5== ".count(array_unique($sw5))."<br>";*/
        die;
    }

    public function test2Action()
    {

        echo '这里写测试代码';
        //\hl\library\Functions\Helper::message();
        echo \hl\library\Functions\Helper::getClientIP();
        echo \hl\library\Functions\Helper::execTime();

        die;
        //亲求的时间
        \hl\library\Functions\Helper::dump(REQUEST_TIME_FLOAT);

        $html = <<<HTML
<html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

     <title>PHP: Hypertext Preprocessor</title>

 <link rel="shortcut icon" href="http://php.net/favicon.ico">
 <link rel="search" type="application/opensearchdescription+xml" href="http://php.net/phpnetimprovedsearch.src" title="Add PHP.net search">
 <link rel="alternate" type="application/atom+xml" href="http://php.net/releases/feed.php" title="PHP Release feed">
 <link rel="alternate" type="application/atom+xml" href="http://php.net/feed.atom" title="PHP: Hypertext Preprocessor">

 <link rel="canonical" href="http://php.net/index.php">
 <link rel="shorturl" href="http://php.net/index">
 <link rel="alternate" href="http://php.net/index" hreflang="x-default">
   </head>
   <body>       
    <ul class="nav">
      <li class=""><a href="/downloads">Downloads</a></li>
      <li class=""><a href="/docs.php">Documentation</a></li>
      <li class=""><a href="/get-involved" >Get Involved</a></li>
      <li class=""><a href="/support">Help</a></li>
    </ul>
    <table>
        <tr>
            <th>a</th>
            <th>b</th>
            <th>e</th>
            <th>d</th>
            <th>c</th>
        </tr>
        <tr>
            <td>sdf</td>
            <td>ssdfdf</td>
            <td>sfgdf</td>
            <td>svbdf</td>
            <td>sbndf</td>
        </tr>
        <tr>
            <td>s士大夫df</td>
            <td>sd士大夫f</td>
            <td>s法的规定df</td>
            <td>s法国和df</td>
            <td>s房管局df</td>
        </tr>
    </table>
   </body>
</html>
HTML;
 //$html = file_get_contents('http://tablesorter.com/docs/');
        $hta = new \hl\library\Tools\Html2Array\HLHtmlToArray($html);
        \hl\library\Functions\Helper::dump($hta->toJson());
        \hl\library\Functions\Helper::dump($hta->toArray());
        /**
 * Get html source from tablesorter.com
 */
echo '<hr>';
/**
 * Print array of table rows for each table
 */
print_r($hta->getArrayOfTr());
echo '<hr>';
/**
 * Print array of table columns for each table
 */
print_r($hta->getArrayOfTd(true));
echo '<hr>';
/**
 * Print array of table headers for each table
 */
print_r($hta->getArrayOfTh(true));
echo '<hr>';
/**
 * Returns array of tables
 *
 * @param bool $get_only_text (optional)
 * @return array
 */
print_r($hta->getArrayOfTables(false));
echo '<hr>';
        $str = exampleServices::getInstance()->todo();

        $str = \hl\library\Functions\Helper::alert('sdfsdf', 'sfsdfsd', 'http://mysweet95.com');
        //传递值到模板
        \hl\HLView::param('out', $str);
//        \hl\library\Functions\Helper::dump('sdf');
    }
}
