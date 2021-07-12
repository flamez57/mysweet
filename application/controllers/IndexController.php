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
use application\models\example2Models;
use application\models\wampModels;
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
        $body_param = '{"scene":"19","page":"pages/common/redirect","width":null,"auto_color":null,"line_color":null}';
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=46_G-zH5sa-qvB-YXlpMZ-qzFny5J6p5liXRAyawq7WMGey4Ek4Yd-zPj07ch2RacYrVzgiBawZ2RkleTd0XbJN9LgkRBZrJOSWgWJqULlhIuf619vY45_uNldpnBiEW6-nboEau_lUcWPaRJXcDDJcABAQQW';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body_param);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($data == NULL) {
		    $errInfo = "call http err :" . curl_errno($ch) . " - " . curl_error($ch);
		    curl_close($ch);
        } elseif($responseCode  != "200") {
		    $errInfo = "call http err httpcode=" . $responseCode;
		    curl_close($ch);
        } else {
		    curl_close($ch);
        }
//        curl_close($ch);
		var_dump($errInfo);
		var_dump($data);
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

    public function test58Action()
    {
        die();
        ini_set('max_execution_time', '3600');
        /*$rows = exampleModels::getInstance()->aa(
            "select DISTINCT m.member_id,m.code,case when mp.role = 1 then '店主' when mp.role = 2 then '主管' when mp.role > 2 then '经理' else '普通用户' end AS role
from sl_order o 
left join sl_member m on m.member_id = o.member_id 
left join sl_member_plus mp on mp.member_id = m.member_id
where o.create_time >= UNIX_TIMESTAMP('2020-01-01') and o.status > 0"
        );
        echo '一共'.count($rows).'<br>';
        foreach ($rows as $_row) {
            if ($_row['member_id'] > 96800532) {
                wampModels::getInstance()->insert(
                    'sl_gold_egg',
                    [
                        'member_id' => $_row['member_id'],
                        'role' => $_row['role'],
                        'code' => $_row['code'],
                    ]
                );
            }
        }
        echo 'success';
        die;
        $data = [];*/
        $id = $this->getQuery('id', 94099265);
        while ($rows = wampModels::getInstance()->aa(
            "select member_id from sl_gold_egg where member_id > {$id} order by member_id asc limit 1000"
        )) {
            foreach ($rows as $_row) {
                $updata = [];
                $useSql = "select member_id,sum(total_egg) AS num,sum(last_amount) AS amount,FROM_UNIXTIME(create_time, '%m') AS mon
from sl_order  
where member_id = {$_row['member_id']} and create_time >= UNIX_TIMESTAMP('2020-11-01') and status > 0 group by FROM_UNIXTIME(create_time, '%m')";
                $ores = exampleModels::getInstance()->aa($useSql);
                if (!empty($ores)) {
                    foreach ($ores as $_ore) {
                        switch ($_ore['mon']) {
                            case '01':
                                $updata['b_1'] = $_ore['num'];
                                $updata['c_1'] = $_ore['amount'];
                                break;
                            case '11':
                                $updata['b_11'] = $_ore['num'];
                                $updata['c_11'] = $_ore['amount'];
                                break;
                            case '12':
                                $updata['b_12'] = $_ore['num'];
                                $updata['c_12'] = $_ore['amount'];
                                break;
                        }
                    }
                }

                $getSql = "select sum(change_num) AS num,FROM_UNIXTIME(create_time, '%m') AS mon
from sl_member_gold_egg_log  
where member_id = {$_row['member_id']} and create_time >= UNIX_TIMESTAMP('2020-11-01') and change_num > 0 group by FROM_UNIXTIME(create_time, '%m')";
                $getArr = exampleModels::getInstance()->aa($getSql);
                if (!empty($getArr)) {
                    foreach ($getArr as $_get) {
                        switch ($_get['mon']) {
                            case '01':
                                $updata['a_1'] = $_get['num'];
                                break;
                            case '11':
                                $updata['a_11'] = $_get['num'];
                                break;
                            case '12':
                                $updata['a_12'] = $_get['num'];
                                break;
                        }
                    }
                }
                if (!empty($updata)) {
                    wampModels::getInstance()->update('sl_gold_egg', $updata, ['member_id' => $_row['member_id']]);
                }
                $id = $_row['member_id'];
            }
            echo $id . '<br>';
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
            echo '-- ' . $_list[0] . '___' . $i;
            echo '<br>';
            //拉新
            $sql1 = "select id,packet_num,packet_type,packet_amount,create_time from sl_gold_miner_red_packets_log " .
                "where member_id = '{$_list[0]}' and level_type = 1 and packet_status = 1 and packet_type = 1 order by id asc";
            $list1 = exampleModels::getInstance()->aa($sql1);
            //var_dump($list1);
            //非拉新
            $sql2 = "select id,packet_num,packet_type,packet_amount,create_time from sl_gold_miner_red_packets_log " .
                "where member_id = '{$_list[0]}' and level_type = 1 and packet_status = 1 and packet_type = 0 order by id asc";
            $list2 = exampleModels::getInstance()->aa($sql2);
            //var_dump($list2);
            $openTime = end($list2)['create_time'];
            if ($list1) {
                foreach ($list1 as $_list1) {
                    if ($openTime < 1604207488) { //0.88
                        echo "update sl_gold_miner_red_packets_log set packet_amount = " . 0.88 * $_list1['packet_num'] . " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (0.88 * $_list1['packet_num']);
                    } elseif ($openTime >= 1604207488 && $openTime < 1604207504) { // 1.68
                        echo "update sl_gold_miner_red_packets_log set packet_amount = " . 1.68 * $_list1['packet_num'] . " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (1.68 * $_list1['packet_num']);
                    } elseif ($openTime >= 1604207504) { // 1.26
                        echo "update sl_gold_miner_red_packets_log set packet_amount = " . 1.26 * $_list1['packet_num'] . " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (1.26 * $_list1['packet_num']);
                    }
                }
            }
            $num = array_sum(array_column($list2, 'packet_num'));
            $unit = floor($fixamount * 100 / $num) / 100;
            foreach ($list2 as $_list2) {
                if ($num == $_list2['packet_num']) {
                    echo "update sl_gold_miner_red_packets_log set packet_amount = " . $fixamount . " where id = '{$_list2['id']} limit 1';<br>";
                } else {
                    echo "update sl_gold_miner_red_packets_log set packet_amount = " . $unit * $_list2['packet_num'] . " where id = '{$_list2['id']} limit 1';<br>";
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
                    echo $_v . '<br>';
                }
            }
            foreach ($a['qualification'] as $__v) {
                if (strpos($__v['aptitude_image'], '/G0/')) {
                    $data[] = $__v['aptitude_image'];
                    echo $__v['aptitude_image'] . '<br>';
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
                                '供应链商品id' => $_list['supplier_goods_id'] . "\t",
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
                                '供应链商品id' => $_list['supplier_goods_id'] . "\t",
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
        $csv->setTableHead(['code', 'zi_gou', 'title', 'pcs', 'fee', 'zero', 'weg', 'fee', 'zero']);
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

    public function test624Action()
    {
        $time = time();
        $cates = exampleModels::getInstance()->aa(
            "select DISTINCT member_id from sl_mtree_award"
        );
        $memberIds = array_column($cates, 'member_id');
        $memberIdStr = implode(',', $memberIds);
        echo time() - $time;
        echo '<br>';
        $orderList = exampleModels::getInstance()->aa(
            "select o.member_id,o.shareid,og.price,og.qty_remain,og.qty,og.real_amount,og.promotion_type,og.goods_id,o.create_time from sl_order o
left join sl_order_goods og on og.order_id = o.id
where o.pay_status = 1 and og.promotion_type <> 13 and og.qty_remain > 0 and o.order_type = 0 and o.create_time between UNIX_TIMESTAMP('2021-06-18') and UNIX_TIMESTAMP('2021-06-19')
"
        );
        echo time() - $time;
        echo '<br>';
        $self = []; //自购
        $son = []; //儿子
        $person = [];
        $amount = 0;
        if (!empty($orderList)) {
            //排除超级爆品
            $orderList = array_filter($orderList, function ($row) {
                if ($row['promotion_type'] == 12) {
                    return false;
                }
                return true;
            });
            echo time() - $time;
            echo '<br>';
            //排除指定积分商品
            $configList = exampleModels::getInstance()->aa(
                "select goods_id,started_at,end_at from sl_point_activity_config where started_at < UNIX_TIMESTAMP('2021-06-19') and end_at > UNIX_TIMESTAMP('2021-06-18') and status = 1"
            );
            echo time() - $time;
            echo '<br>';
            if (!empty($configList)) {
                $orderList = array_filter($orderList, function ($row) use ($configList) {
                    foreach ($configList as $config) {
                        if ($row['goods_id'] == $config['goods_id']) {
                            //判断时间
                            if ($row['create_time'] >= $config['started_at']
                                && $row['create_time'] < $config['end_at']
                            ) {
                                return false;
                            }
                        }
                    }
                    return true;
                });
            }
            echo time() - $time;
            echo '<br>';
            $memberIdsKey = array_fill_keys($memberIds, '1');
            echo time() - $time;
            echo '<br>';
            foreach ($orderList as $order) {
                if (isset($memberIdsKey[$order['member_id']])) {
                    $person[] = $order['member_id'];
                    if (isset($self[$order['member_id']])) {
                        $self[$order['member_id']] += $order['price'] * $order['qty_remain'];
                    } else {
                        $self[$order['member_id']] = $order['price'] * $order['qty_remain'];
                    }
                }
                if (isset($memberIdsKey[$order['shareid']])) {
                    $person[] = $order['shareid'];
                    $person[] = $order['member_id'];
                    if (isset($son[$order['shareid']])) {
                        $son[$order['shareid']] += $order['price'] * $order['qty_remain'];
                    } else {
                        $son[$order['shareid']] = $order['price'] * $order['qty_remain'];
                    }
                    if (isset($self[$order['member_id']])) {
                        $self[$order['member_id']] += $order['price'] * $order['qty_remain'];
                    } else {
                        $self[$order['member_id']] = $order['price'] * $order['qty_remain'];
                    }
                }
                $amount += $order['price'] * $order['qty_remain'];
            }
            echo time() - $time;
            echo '<br>';
        }
        $person = array_unique($person);
        $data = [
            'self' => $self,
            'son' => $son,
            'num' => count($person),
            'amount' => $amount,
            'person' => $person
        ];
        var_dump($data);
        die;
    }

    public function test618Action()
    {
        $list = wampModels::getInstance()->aa(
            "select * from sl_goods_3"
        );
        $data = [];
        foreach ($list as $_list) {
            if (isset($data[$_list['cate_3']])) {
                $data[$_list['cate_3']]['attr'] = array_unique(
                    array_merge($data[$_list['cate_3']]['attr'], explode(',', $_list['attr']))
                );
            } else {
                $data[$_list['cate_3']] = [
                    'cate_1_name' => $_list['cate_1_name'],
                    'cate_2_name' => $_list['cate_2_name'],
                    'cate_3_name' => $_list['cate_3_name'],
                    'attr' => explode(',', $_list['attr'])
                ];
            }
        }
        foreach ($data as $_data) {
            $_data['attr'] = implode(',', $_data['attr']);
            $out[] = $_data;
        }
        //var_dump($data);
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('2021616');
        //设置表头
        $csv->setTableHead(['cate_1', 'cate_2', 'cate_3', 'attr']);
        //导出数据
        $csv->putout($out);
        //var_dump($data);
        die;
    }

    public function test6126Action()
    {
        ini_set('max_execution_time', '3600');
        $cates = exampleModels::getInstance()->aa(
            "select id,name from sl_goods_categories"
        );
        $cates = array_column($cates, 'name', 'id');
        $id = 17611;
        while ($rows = exampleModels::getInstance()->aa(
            "select seller_id,store_id from sl_seller where web_site = 'SRM' and seller_id > {$id} order by seller_id asc limit 10"
        )) {
            foreach ($rows as $row) {
                $goods = exampleModels::getInstance()->aa(
                    "select id,cate_1,cate_2,cate_3 from sl_goods where seller_id = {$row['seller_id']} and store_id = {$row['store_id']}"
                );
                if (!empty($goods)) {
                    foreach ($goods as $_goods) {
                        $attr = exampleModels::getInstance()->aa(
                            "select attrs from sl_goods_body where goods_id = {$_goods['id']}"
                        );
                        $attrs = json_decode($attr[0]['attrs'], true);
                        $outattr = [];
                        foreach ($attrs as $_attr) {
                            $outattr = array_merge($outattr, array_keys($_attr));
                        }

                        $has = wampModels::getInstance()->aa("select id,attr where cate_1 = {$_goods['cate_1']} and cate_2 = {$_goods['cate_2']} and cate_3 = {$_goods['cate_3']}");
                        if ($has) {
                            wampModels::getInstance()->update(
                                'sl_goods_3',
                                ['attr' => implode(',', array_unique(array_merge(explode(',', $has[0]['attr']), $outattr)))],
                                ['id' => $has[0]['id']]
                            );
                        } else {
                            wampModels::getInstance()->insert(
                                'sl_goods_3',
                                [
                                    'cate_1' => $_goods['cate_1'],
                                    'cate_1_name' => $cates[$_goods['cate_1']] ?? '',
                                    'cate_2' => $_goods['cate_2'],
                                    'cate_2_name' => $cates[$_goods['cate_2']] ?? '',
                                    'cate_3' => $_goods['cate_3'],
                                    'cate_3_name' => $cates[$_goods['cate_3']] ?? '',
                                    'attr' => implode(',', $outattr)
                                ]
                            );
                        }
                    }
                }
                $id = $row['seller_id'];
            }
            echo '===>' . $id . '<===<br>';
        }

    }

    public function test616Action()
    {
        ini_set('max_execution_time', '3600');
        $stores = [];
        $s_c = [];
        $s_c_n = [];
        $s_c_2 = [];
        $s_c_2_n = [];
        $id = 0;
        $cates = exampleModels::getInstance()->aa(
            "select id,name from sl_goods_categories where top_id = 0"
        );
        $cates = array_column($cates, 'name', 'id');

        while ($rows = exampleModels::getInstance()->aa(
            "select * from sl_goods where id > {$id} and status = 1 and is_delete = 0 order by id asc limit 100"
        )) {
            foreach ($rows as $row) {
                if (!isset($s_c[$row['store_id']])) {
                    $store = exampleModels::getInstance()->aa("select sc_id,store_name from sl_store where store_id = {$row['store_id']}");
                    $stores[$row['store_id']] = $store[0]['store_name'];
                    $s_c[$row['store_id']] = $store[0]['sc_id'];
                    $s_c_n[$row['store_id']] = $cates[$store[0]['sc_id']] ?? '';
                    $bind = exampleModels::getInstance()->aa("select class1_id from sl_store_bind_class where store_id = {$row['store_id']}");
                    if ($bind) {
                        foreach ($bind as $_bind) {
                            $s_c_2[$row['store_id']][] = $_bind['class1_id'];
                            $s_c_2_n[$row['store_id']][] = $cates[$_bind['class1_id']] ?? '';
                        }
                    }
                }
                if ($row['cate_1'] != $s_c[$row['store_id']] && !in_array($row['cate_1'], $s_c_2[$row['store_id']])) {
                    $data = [
                        'store_id' => $row['store_id'],
                        'goods_id' => $row['id'],
                        'title' => $row['title'],
                        'cate_1' => $row['cate_1'],
                        'store_name' => $stores[$row['store_id']] ?? '',
                        'cate_1_name' => $cates[$row['cate_1']] ?? '',
                        's_cate_name' => $s_c_n[$row['store_id']] ?? '',
                        's_cate' => implode(',', $s_c_2_n[$row['store_id']] ?? [])
                    ];
                    //var_dump($data);
                    wampModels::getInstance()->insert('sl_goods_2', $data);
                }
                $id = $row['id'];
            }
        }
    }
    public function test79Action()
    {
        ini_set('max_execution_time', '3600');
        $id = 77668;
        while ($rows = exampleModels::getInstance()->aa(
            "select id,play_time,member_id,helper_number_ids from sl_mtree_help where helper_number_ids != '' and id > {$id} limit 10"
        )) {
            foreach ($rows as $row) {
                $data = [
                    'play_time' => $row['play_time'],
                    'member_id' => $row['member_id'],
                    'helper_number_ids' => $row['helper_number_ids'],
                    'create_time' => count(explode(',', $row['helper_number_ids']))
                ];
                wampModels::getInstance()->insert('sl_mtree_help', $data);
                $id = $row['id'];
            }
        }
    }


    public function test6282Action()
    {
        ini_set('max_execution_time', '3600');
        $id = 97445257;
        while ($rows = exampleModels::getInstance()->aa(
            "select member_id from sl_mtree_member_level where member_id > {$id} limit 100"
        )) {
            foreach ($rows as $row) {
                $member = exampleModels::getInstance()->aa(
                    "select member_id,level_type,FROM_UNIXTIME(create_time, '%d') as t from sl_mtree_red_packets_log where member_id = {$row['member_id']} and level_type in (1,2,3)"
                );
                if (!empty($member)) {
                    $data = [];
                    foreach ($member as $_v) {
                        $data['member_id'] = $_v['member_id'];
                        $data['cate_'.$_v['level_type']] = $_v['t'];
                    }

                }
                $id = $row['member_id'];
            }
        }
    }

    public function testAction()
    {
        ini_set('max_execution_time', '3600');
        $stores = [];
        $cates = [];
        $id = 928841;
        $time = time();
        $act = exampleModels::getInstance()->aa(
            "select goods_id,prom_type,prom_id from sl_activity_summary where status = 1 and end_time > {$time} and prom_type in (5,6)"
        );
        $act = array_combine(array_column($act, 'goods_id'), $act);
                //var_dump($act);
        //单独设置利润点
        $storeCate = exampleModels::getInstance()->aa(
            "select store_id,cate_2,profit from sl_store_cate_profit where status = 1 and end_time > {$time} and start_time < {$time}"
        );
        $storeCates = [];
        if (!empty($storeCate)) {
            foreach ($storeCate as $_cate) {
                $storeCates[$_cate['store_id']][$_cate['cate_2']] = $_cate['profit'];
            }
        }

        while ($rows = exampleModels::getInstance()->aa(
            "select * from sl_goods where id > {$id} and status = 1 and is_delete = 0 order by id asc limit 100"
        )) {
            foreach ($rows as $row) {
                if (!isset($stores[$row['store_id']])) {
                    $store = exampleModels::getInstance()->aa("select store_name,store_profit from sl_store where store_id = {$row['store_id']}");
                    $stores[$row['store_id']] = $store[0];
                }
                if (!isset($cates[$row['cate_2']])) {
                    $cate = exampleModels::getInstance()->aa("select id,name,profit from sl_goods_categories where id in ({$row['cate_1']},{$row['cate_2']})");
                    if (!empty($cate)) {
                        foreach ($cate as $_cate) {
                            $cates[$_cate['id']] = $_cate;
                        }
                    }
                }
                $p = [bcmul(bcdiv(bcsub($row['price'], $row['cost_price'], 2), $row['price'], 2), 100, 2)];
                $sku = exampleModels::getInstance()->aa("select * from sl_goods_sku where goods_id = {$row['id']}");
                if (!empty($sku)) {
                    foreach ($sku as $_sku) {
                        $p[] = bcmul(bcdiv(bcsub($_sku['price'], $_sku['cost_price'], 2), $_sku['price'], 2), 100, 2);
                    }
                }
                $c_p = min($p);
                if ((isset($storeCates[$row['store_id']][$row['cate_2']]) && $c_p < $storeCates[$row['store_id']][$row['cate_2']]) ||
                    (!isset($storeCates[$row['store_id']][$row['cate_2']]) && $c_p < $cates[$row['cate_2']]['profit'])) {
                    if (isset($act[$row['id']])) {
                        $prom_type = $act[$row['id']]['prom_type'];
                        $prom_id = $act[$row['id']]['prom_id'];
                        if ($prom_type == 5) {
                            $every = exampleModels::getInstance()->aa(
                                "select act_time from sl_activity_every_day_special_entry where id = {$prom_id}"
                            );
                            $act_title = date('Y-m-d', $every[0]['act_time']);
                        } elseif ($prom_type == 6)  {
                            $com1 = exampleModels::getInstance()->aa(
                                "select act_id from sl_activity_common_entry where id = {$prom_id}"
                            );
                            $com2 = exampleModels::getInstance()->aa(
                                "select act_title from sl_activity_common where id = {$com1[0]['act_id']}"
                            );
                            $act_title = $com2[0]['act_title'];
                        }
                    } else {
                        $prom_type = 0;
                        $prom_id = 0;
                        $act_title = '';
                    }
//                    if (!in_array($row['store_id'], [5973, 5974, 5975, 5983, 5984, 5994, 5997, 6001, 6002, 6003, 6004, 6006, 6080, 6081])) {
//
//                    }
                    $data = [
                        'store_id' => $row['store_id'],
                        'store_name' => $stores[$row['store_id']]['store_name'] ?? '',
                        'cate_1' => $row['cate_1'],
                        'cate_2' => $row['cate_2'],
                        'cate_1_name' => $cates[$row['cate_1']]['name'] ?? '',
                        'cate_2_name' => $cates[$row['cate_2']]['name'] ?? '',
                        'goods_id' => $row['id'],
                        'title' => $row['title'],
                        'g_profit' => $c_p,
                        's_profit' => $stores[$row['store_id']]['store_profit'] ?? 0,
                        'c_profit' => $cates[$row['cate_2']]['profit'] ?? '',
                        'prom_type' => $prom_type,
                        'prom_id' => $prom_id,
                        'act_title' => $act_title,
                    ];
                    wampModels::getInstance()->insert('sl_goods', $data);
                }
                $id = $row['id'];
            }
        }



       // var_dump($rows);
        echo 'ok';
        die;
    }

    /*
    ** 兆骏用程序
    */
    public function test202162Action()
    {
        $out = [];
        $path = 'lrd.csv';
        $csv = new \hl\library\Tools\Excel\HLCsvReader();
        $data = $csv->getData($path);
        foreach ($data as $k => $v) {
            //echo $v[0].'-'.$v[3];
            //echo '<br>';
            $sql = "select AVG((sku.price-sku.cost_price)/sku.price ) as 'yongjin',AVG((sku.cost_price-sku.seller_cost_price)/sku.cost_price ) as 'lirun' from srm_goods_sku as sku 
left join srm_goods  on sku.goods_id=srm_goods.id
 where srm_goods.store_id= {$v[0]} and srm_goods.cate_1 = {$v[3]}";
            $row = example2Models::getInstance()->aa($sql);
            $out[] = [
                'store_id' => $v[0],
                'cate_1' => $v[3],
                'yj' => $row[0]['yongjin'],
                'lr' => $row[0]['lirun']
            ];
            //var_dump($row);
        }
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('202091');
        //设置表头
        $csv->setTableHead(['store_id', 'cate_1', 'yj', 'lr']);
        //导出数据
        $csv->putout($out);
        //var_dump($data);
        die;
    }
}
