<?php

namespace hl\library\Tools\Excel;

/**
** @ClassName: HLCsvReader
** @Description: 读取csv表格
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月1日 早上10:49
** @version V1.0
*/

class HLCsvReader
{
    public function getData($path)
    {
        $file = fopen($path, 'r');
        //每次读取CSV里面的一行内容
        $i = 1;
        while ($data = fgetcsv($file)) {
            if ($i > 1) {
                $excels[] = $data;
            }
            $i++;
        }
        $excels = eval('return ' . iconv('gbk', 'utf-8', var_export($excels, true)) . ';');
        return $excels;
    }
}
