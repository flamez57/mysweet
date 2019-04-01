<?php

namespace hl\library\Tool\Excel;

/**
** @ClassName: HLPutoutCsv
** @Description: 导出csv表格
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月1日 早上10:49
** @version V1.0
*/

class HLPutoutCsv
{
    /*
    ** 表名
    */
    private $tableName = 'HLPutout';

    /*
    ** 表头
    */
    private $tableHead = [];

    /*
    ** 错误信息
    */
    public $errorMsg = '';

    public function __construct()
    {
        //设置内存占用
        set_time_limit(0);
        ini_set('memory_limit', '512M');
    }

    /**
    ** 设置表名
    ** @param $tableName stirng 表名
    */
    public function setTableName($tableName)
    {
        if (is_string($tableName)) {
            $this->tableName = $tableName;
        }
    }

    /**
    ** 设置表头
    ** @param $tableHead array
    */
    public function setTableHead($tableHead)
    {
        if (is_array($tableHead)) {
            $this->tableName = array_values($tableHead);
        }
    }

    /**
    ** 获取错误信息
    ** @return string
    */
    public function getError()
    {
        return $this->errorMsg;
    }

    /**
    ** 导出数据
    ** @param $data array
    */
    public function putout($data)
    {
        //为fputcsv()函数打开文件句柄
        if ($output = fopen('php://output', 'w')) {
            //告诉浏览器这个是一个csv文件
            header("Content-Type: application/csv");
            header("Content-Disposition: attachment; filename={$this->tableName}.csv");
            //输出表头
            $table_head = $this->tableHead;
            foreach ($table_head as $_key => $_head) {
                $table_head[$_key] = iconv('utf-8', 'gbk', $_head);
            }
            fputcsv($output, $table_head);
            //输出每一行数据到文件中
            if (!empty($data)) {
                foreach ($data as $_d) {
                    //输出内容
                    fputcsv($output, array_values($_d));
                }
            }
            if (fclose($output)) {
                die;
            } else {
                $this->errorMsg = 'can\'t close php://output';
                die;
            }
        } else {
            $this->errorMsg = 'can\'t open php://output';
            die;
        }
    }
}
