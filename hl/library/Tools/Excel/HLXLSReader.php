<?php

namespace hl\library\Tools\Excel;

/**
** @ClassName: HLXLSReader
** @Description: 读取xls表格
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月1日 早上10:49
** @version V1.0
*/

class HLXLSReader
{
    protected $excelDocument;

    /**
     * @var array
     */
    protected $sheets = [];

    /**
     * Konstruktor
     *
     * @param string $file Name der Exceldatei
     */
    public function __construct($file)
    {

        if ($file === '') {
            throw new \Exception("文件路径不能为空");
        }

        if (!file_exists($file)) {
            throw new \Exception("文件{$file}不存在");
        }

        mb_internal_encoding('8bit');

        $this->excelDocument = new XlsParser($file);
        $this->sheets        = $this->excelDocument->getSheets();
    }

    public function sheetCount()
    {
        return count($this->sheets);
    }

    public function rowCount($sheet = 0)
    {
        return $this->sheets[$sheet]['numRows'];
    }

    public function columnCount($sheet = 0)
    {
        return $this->sheets[$sheet]['numCols'];
    }

    public function dump($sheet = 0)
    {
        $ret = [];
        for ($row = 1; $row <= $this->rowCount($sheet); $row++) {
            $columns = null;

            for ($col = 1; $col <= $this->columnCount($sheet); $col++) {
                $columns[$col] = $this->val($row, $col, $sheet);
            }

            $ret[$row] = $columns;
        }

        return $ret;
    }

    public function val($row, $col, $sheet = 0)
    {
        if (array_key_exists($row, $this->sheets[$sheet]['cells'])
            &&
            array_key_exists($col, $this->sheets[$sheet]['cells'][$row])) {
            return $this->sheets[$sheet]['cells'][$row][$col];
        }

        return null;
    }
}
