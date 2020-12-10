<?php
namespace blogapi\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use application\models\installModels;
use application\models\exampleModels;
use application\models\example2Models;
use application\models\wampModels;
use blogapi\services\memberServices;
use hl\HLApi;
use application\services\exampleServices;
use application\services\installServices;
use hl\library\Tools\HLResponse;

class IndexController extends HLApi
{
    /*
     * 分类
     */
    public function cateListAction()
    {
        $code = $this->getQuery('code', '');
    }
    /*
     * 标签
     */
    /*
     * 文章列表
     */
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
     * 详情
     */
    /*
     * 发表看法
     */
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        //框架欢迎页
        HLResponse::json($this->code, $this->message, $this->data);
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
        ini_set('max_execution_time', '1800');
        $data = [];
        $id = 95158239;
        while ($rows = exampleModels::getInstance()->aa(
            "select mml.member_id,m.regtime,mp.role from sl_gold_miner_member_level mml 
left join sl_member_plus mp on mp.member_id = mml.member_id
left join sl_member m on m.member_id = mml.member_id where mml.member_id > {$id} and mml.level > 0 order by mml.member_id asc limit 10"
        )) {
            foreach ($rows as $_row) {
                $inData = [
                    'member_id' => $_row['member_id'],
                    'role' => empty($_row['role']) ? 0 : $_row['role'],
                    'day_1' => '0',
                    'day_2' => '0',
                    'day_3' => '0',
                    'day_4' => '0',
                    'day_5' => '0',
                    'day_6' => '0',
                    'day_7' => '0',
                    'day_8' => '0',
                    'day_9' => '0',
                    'day_10' => '0',
                    'regtime' => $_row['regtime'],
                ];
                $sql = "select create_time from sl_gold_miner_gold_ore_log where member_id = {$_row['member_id']} and source <= 20";
                $ores = exampleModels::getInstance()->aa($sql);
                $aaa = ['day_1','day_2','day_3','day_4','day_5','day_6','day_7','day_8','day_9','day_10'];
                $ccc = ['day_1' => '0',
                    'day_2' => '0',
                    'day_3' => '0',
                    'day_4' => '0',
                    'day_5' => '0',
                    'day_6' => '0',
                    'day_7' => '0',
                    'day_8' => '0',
                    'day_9' => '0',
                    'day_10' => '0',];
                if ($ores) {
                    foreach ($ores as $_ore) {
                        if (in_array('day_'. intval(date('d', $_ore['create_time'])), $aaa)) {
                            $inData['day_'. intval(date('d', $_ore['create_time']))] = '1';
                            unset($ccc['day_'. intval(date('d', $_ore['create_time']))]);
                        }
                    }
                }

                if (!empty($ccc)) {
                    $teams = exampleModels::getInstance()->aa("select play_time from sl_gold_miner_team where member_id = {$_row['member_id']}");
                    if ($teams) {
                        foreach ($teams as $_team) {
                            if (in_array('day_'. intval(date('d', $_team['play_time'])), $aaa)) {
                                $inData['day_'. intval(date('d', $_team['play_time']))] = '1';
                                unset($ccc['day_'. intval(date('d', $_team['play_time']))]);
                            }
                        }
                    }
                }
                if (!empty($ccc)) {
                    $areas = exampleModels::getInstance()->aa("select create_time from sl_gold_miner_area_member where member_id = {$_row['member_id']}");
                    if ($areas) {
                        foreach ($areas as $_area) {
                            if (in_array('day_'. intval(date('d', $_area['create_time'])), $aaa)) {
                                $inData['day_'. intval(date('d', $_area['create_time']))] = '1';
                            }
                        }
                    }
                }
                wampModels::getInstance()->insert('sl_gold_miner', $inData);
                $id = $_row['member_id'];
            }
//            var_dump($rows);
//            die;
        }
        die;
        //参与用户数（定义：完成赚金矿的某一项日常任务或加入大区或参与组队pk即算参与）

        /*$sql = "select price_rule_id,goods_id from srm_goods where STATUS = 1";
        $rows = example2Models::getInstance()->aa($sql);
        foreach ($rows as $_row) {
            if (isset($data[$_row['price_rule_id']])) {
                $data[$_row['price_rule_id']] .= ','.$_row['goods_id'];
            } else {
                $data[$_row['price_rule_id']] = $_row['goods_id'];
            }

        }
        echo '<table border = "1">';
        foreach ($data as $_k => $_v) {
            $_tmp = exampleModels::getInstance()->aa("select sum(real_sales) num from sl_goods_data where goods_id in ({$_v}) limit 1");
            echo '<tr>';
            echo '<td>'.$_k.'</td>';
            echo '<td>'.$_tmp[0]['num'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
        var_dump($data);
        die;*/
        /*
        $sql = "select rpl.member_id,count(rpl.id) as c from sl_gold_miner_red_packets_log rpl
left join sl_member_plus mp on mp.member_id = rpl.member_id
where rpl.packet_type = 1 and create_time >= UNIX_TIMESTAMP('2020-11-01') and rpl.create_time < UNIX_TIMESTAMP('2020-11-10 22:00') 
and mp.role >= 3
GROUP by rpl.member_id";
        $rows = exampleModels::getInstance()->aa($sql);
        $t1 = 0;
        foreach ($rows as $_row) {
            if ($_row['c'] <= 5) {
                if (isset($data[$t1][$_row['c']])) {
                    $data[$t1][$_row['c']]++;
                } else {
                    $data[$t1][$_row['c']] = 1;
                }
            } elseif ($_row['c'] >= 6 && $_row['c'] <= 10) {
                if (isset($data[$t1][6])) {
                    $data[$t1][6]++;
                } else {
                    $data[$t1][6] = 1;
                }
            } elseif ($_row['c'] >= 10 && $_row['c'] <= 20) {
                if (isset($data[$t1][7])) {
                    $data[$t1][7]++;
                } else {
                    $data[$t1][7] = 1;
                }
            } elseif ($_row['c'] > 20 && $_row['c'] <= 30) {
                if (isset($data[$t1][8])) {
                    $data[$t1][8]++;
                } else {
                    $data[$t1][8] = 1;
                }
            } elseif ($_row['c'] > 30 && $_row['c'] <= 40) {
                if (isset($data[$t1][9])) {
                    $data[$t1][9]++;
                } else {
                    $data[$t1][9] = 1;
                }
            } elseif ($_row['c'] > 40 && $_row['c'] <= 50) {
                if (isset($data[$t1][10])) {
                    $data[$t1][10]++;
                } else {
                    $data[$t1][10] = 1;
                }
            } else {
                if (isset($data[$t1][11])) {
                    $data[$t1][11]++;
                } else {
                    $data[$t1][11] = 1;
                }
            }
        }
        echo '<table border = "1">';
        for ($i = 1; $i <= 11; $i++) {
            echo '<tr>';
            echo '<td>'. ($data[0][$i] ?? 0) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        die;*/
        /*
        $t1 = strtotime(date('2020-11-01'));
        $t0 = $t1;
        while ($t1 < strtotime(date('2020-11-11'))) {
            $t2 = $t1 + 86400;
            $rows = exampleModels::getInstance()->aa("select member_id,count(id) AS c from sl_gold_miner_red_packets_log 
where packet_type = 1 and create_time >= {$t1} and create_time < {$t2} GROUP by member_id");
            foreach ($rows as $_row) {
                if ($_row['c'] <= 5) {
                    if (isset($data[$t1][$_row['c']])) {
                        $data[$t1][$_row['c']]++;
                    } else {
                        $data[$t1][$_row['c']] = 1;
                    }
                } elseif ($_row['c'] >= 6 && $_row['c'] <= 10) {
                    if (isset($data[$t1][6])) {
                        $data[$t1][6]++;
                    } else {
                        $data[$t1][6] = 1;
                    }
                } elseif ($_row['c'] >= 10 && $_row['c'] <= 20) {
                    if (isset($data[$t1][7])) {
                        $data[$t1][7]++;
                    } else {
                        $data[$t1][7] = 1;
                    }
                } elseif ($_row['c'] > 20 && $_row['c'] <= 30) {
                    if (isset($data[$t1][8])) {
                        $data[$t1][8]++;
                    } else {
                        $data[$t1][8] = 1;
                    }
                } elseif ($_row['c'] > 30 && $_row['c'] <= 40) {
                    if (isset($data[$t1][9])) {
                        $data[$t1][9]++;
                    } else {
                        $data[$t1][9] = 1;
                    }
                } elseif ($_row['c'] > 40 && $_row['c'] <= 50) {
                    if (isset($data[$t1][10])) {
                        $data[$t1][10]++;
                    } else {
                        $data[$t1][10] = 1;
                    }
                } else {
                    if (isset($data[$t1][11])) {
                        $data[$t1][11]++;
                    } else {
                        $data[$t1][11] = 1;
                    }
                }
            }
            $t1 = $t2;
        }

        //var_dump($data);
        echo '<table border = "1">';
        for ($i = 1; $i <= 11; $i++) {
            echo '<tr>';
            for ($j = 0; $j <= 10; $j ++) {
                echo '<td>'. ($data[$t0 + (86400 * $j)][$i] ?? 0) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        die;
        */
        /*while ($rows = exampleModels::getInstance()->aa(
            "select mam.member_id,mam.area_id,mam.create_time,mp.role from sl_gold_miner_area_member mam
left join sl_member_plus mp on mp.member_id = mam.member_id where mam.member_id > {$id} limit 100"
        )) {
            foreach ($rows as $_row) {
                if (empty($_row['role'])) {
                    $key2 = 0;
                } elseif ($_row['role'] >= 3) {
                    $key2 = 3;
                } else {
                    $key2 = $_row['role'];
                }
                $day = date('d', $_row['create_time']);
                if (isset($data[$_row['area_id']][$key2][$day])) {
                    $data[$_row['area_id']][$key2][$day]++;
                } else {
                    $data[$_row['area_id']][$key2][$day] = 1;
                }
                $id = $_row['member_id'];
            }
        }

        //var_dump($data);
        echo '<table>';
        foreach ($data as $_k => $_v) {
            echo '<tr><td>'.$_k.'</td></tr>';
            for ($i = 0; $i <= 3; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= 10; $j++) {
                    if ($j < 10) {
                        echo '<td>'. ($data[$_k][$i]['0'.$j] ?? 0) . '</td>';
                    } else {
                        echo '<td>'. ($data[$_k][$i][$j] ?? 0) . '</td>';
                    }
                }
                echo '</tr>';
            }
        }
        echo '</table>';
        die;*/
        /*while ($rows = exampleModels::getInstance()->aa(
            "select mml.member_id,mml.level,mp.role,mml.full_level_time from sl_gold_miner_member_level mml
left join sl_member_plus mp on mp.member_id = mml.member_id
where mml.member_id > {$id} and mml.level > 14 and mml.level <= 19 limit 100"
        )) {
            $member_ids = implode(',', array_column($rows, 'member_id'));
            $sql = "select DISTINCT member_id,create_time from sl_gold_miner_red_packets_log ".
                    "where member_id IN({$member_ids}) and level_type = 3 group by member_id order by id desc ";
            $times = exampleModels::getInstance()->aa($sql);
            foreach ($times as $_time) {
                $keyDays[$_time['member_id']] = date('d', $_time['create_time'] + 3600 * 8);
            }
            foreach ($rows as $_row) {
                if ($_row['level'] <= 12) {
                    $key1 = 1;
                } elseif ($_row['level'] >= 13 && $_row['level'] <= 14) {
                    $key1 = 2;
                } elseif ($_row['level'] >= 15 && $_row['level'] <= 19) {
                    $key1 = 3;
                } elseif ($_row['level'] == 20) {
                    $key1 = 4;
                }
                if (empty($_row['role'])) {
                    $key2 = 0;
                } elseif ($_row['role'] >= 3) {
                    $key2 = 3;
                } else {
                    $key2 = $_row['role'];
                }
                if (isset($data[$key1][$key2]['num'])) {
                    $data[$key1][$key2]['num']++;
                } else {
                    $data[$key1][$key2]['num'] = 1;
                }
                $num = $keyDays[$_row['member_id']] ?? 10;
//                if ($num == 0) {
//                    echo $_row['member_id'].'==='.$_row['level'].'<br>';
//                }
                if (isset($data[$key1][$key2][$num])) {
                    $data[$key1][$key2][$num]++;
                } else {
                    $data[$key1][$key2][$num] = 1;
                }
                switch ($key1) {
                    case 1:
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                    case 4:
                        $num = date('d', $_row['full_level_time']);
                        if (isset($data[$key1][$key2][$num])) {
                            $data[$key1][$key2][$num]++;
                        } else {
                            $data[$key1][$key2][$num] = 1;
                        }
                        break;
                }

                $id = $_row['member_id'];
            }
        }*/
        $path = 'wjk.csv';
        $csv = new \hl\library\Tools\Excel\HLCsvReader();
        $data = $csv->getData($path);
        $i = 0;
        foreach ($data as $_list) {
//            if ($i >= 4) {
//                break;
//            }
            $fixamount = $_list[2];
            echo '-- '.$_list[0].'___'.$i;
            echo '<br>';
            //拉新
            $sql1 = "select id,packet_num,packet_type,packet_amount,create_time from sl_gold_miner_red_packets_log ".
                "where member_id = '{$_list[0]}' and level_type = 1 and packet_status = 1 and packet_type = 1 order by id asc";
            $list1 = exampleModels::getInstance()->aa($sql1);
            //var_dump($list1);
            //非拉新
            $sql2 = "select id,packet_num,packet_type,packet_amount,create_time from sl_gold_miner_red_packets_log ".
                "where member_id = '{$_list[0]}' and level_type = 1 and packet_status = 1 and packet_type = 0 order by id asc";
            $list2 = exampleModels::getInstance()->aa($sql2);
            //var_dump($list2);
            $openTime = end($list2)['create_time'];
            if ($list1) {
                foreach ($list1 as $_list1) {
                    if ($openTime < 1604207488) { //0.88
                        echo "update sl_gold_miner_red_packets_log set packet_amount = ". 0.88 * $_list1['packet_num']. " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (0.88 * $_list1['packet_num']);
                    } elseif ($openTime >= 1604207488 && $openTime < 1604207504) { // 1.68
                        echo "update sl_gold_miner_red_packets_log set packet_amount = ". 1.68 * $_list1['packet_num']. " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (1.68 * $_list1['packet_num']);
                    } elseif ($openTime >= 1604207504) { // 1.26
                        echo "update sl_gold_miner_red_packets_log set packet_amount = ". 1.26 * $_list1['packet_num']. " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (1.26 * $_list1['packet_num']);
                    }
                }
            }
            $num = array_sum(array_column($list2, 'packet_num'));
            $unit = floor($fixamount * 100 / $num) / 100;
            foreach ($list2 as $_list2) {
                if ($num == $_list2['packet_num']) {
                    echo "update sl_gold_miner_red_packets_log set packet_amount = ". $fixamount . " where id = '{$_list2['id']} limit 1';<br>";
                } else {
                    echo "update sl_gold_miner_red_packets_log set packet_amount = ". $unit * $_list2['packet_num']. " where id = '{$_list2['id']} limit 1';<br>";
                    $fixamount -= ($unit * $_list2['packet_num']);
                }
                $num -= $_list2['packet_num'];
            }
            unset($openTime);
            unset($list1);
            unset($list2);
            $i++;
        }
        //var_dump($data);

    }
    public function test112Action()
    {
        $sql = "select data from sl_store_update_aptitude where status >= 0 limit 300";
        $list = exampleModels::getInstance()->aa($sql);
        $data = [];
        foreach ($list as $_list) {
            $a = json_decode($_list['data'], true);
            foreach ($a['other_qualification'] as $_v) {
                if (strpos($_v, '/G0/')) {
                    $data[] = $_v;
                    echo $_v.'<br>';
                }
            }
            foreach ($a['qualification'] as $__v) {
                if (strpos($__v['aptitude_image'], '/G0/')) {
                    $data[] = $__v['aptitude_image'];
                    echo $__v['aptitude_image'].'<br>';
                }
            }
        }
        var_dump($data);
    }

    public function test3Action()
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
