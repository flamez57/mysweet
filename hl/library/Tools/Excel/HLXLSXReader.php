<?php

namespace hl\library\Tools\Excel;

/**
** @ClassName: HLXLSXReader
** @Description: 读取xlsx表格
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月1日 早上10:49
** @version V1.0
 * 代码来源：https://github.com/gneustaetter/XLSXReader
XLSXReader is a heavily modified version of:
    SimpleXLSX php class v0.4 (Artistic License)
    Created by Sergey Schuchkin from http://www.sibvision.ru - professional php developers team 2010-2011
    Downloadable here: http://www.phpclasses.org/package/6279-PHP-Parse-and-retrieve-data-from-Excel-XLS-files.html

Key Changes include:
    Separation into two classes - one for the Workbook and one for Worksheets
    Access to sheets by name or sheet id
    Use of ZIP extension
    On-demand access of files inside zip
    On-demand access to sheet data
    No storage of XML objects or XML text
    When parsing rows, include empty rows and null cells so that data array has same number of elements for each row
    Configuration option for removing trailing empty rows
    Better handling of cells with style information but no value
    Change of class names and method names
    Removed rowsEx functionality including extraction of hyperlinks
*/

class HLXLSXReader
{
    protected $sheets = array();
    public $sharedStrings = array();
    protected $sheetInfo;
    protected $zip;
    public $config = array(
        'removeTrailingRows' => true
    );

    // XML schemas
    const SCHEMA_OFFICEDOCUMENT = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument';
    const SCHEMA_RELATIONSHIP = 'http://schemas.openxmlformats.org/package/2006/relationships';
    const SCHEMA_OFFICEDOCUMENT_RELATIONSHIP = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships';
    const SCHEMA_SHAREDSTRINGS = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings';
    const SCHEMA_WORKSHEETRELATION = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet';

    public function __construct($filePath, $config = array())
    {
        $this->config = array_merge($this->config, $config);
        $this->zip = new \ZipArchive();
        $status = $this->zip->open($filePath);
        if ($status === true) {
            $this->parse();
        } else {
            throw new \Exception("Failed to open $filePath with zip error code: $status");
        }
    }

    // get a file from the zip
    protected function getEntryData($name)
    {
        $data = $this->zip->getFromName($name);
        if ($data === false) {
            throw new \Exception("File $name does not exist in the Excel file");
        } else {
            return $data;
        }
    }

    // extract the shared string and the list of sheets
    protected function parse()
    {
        $sheets = array();
        $relationshipsXML = simplexml_load_string($this->getEntryData("_rels/.rels"));
        foreach ($relationshipsXML->Relationship as $rel) {
            if ($rel['Type'] == self::SCHEMA_OFFICEDOCUMENT) {
                $workbookDir = dirname($rel['Target']) . '/';
                $workbookXML = simplexml_load_string($this->getEntryData($rel['Target']));
                foreach ($workbookXML->sheets->sheet as $sheet) {
                    $r = $sheet->attributes('r', true);
                    $sheets[(string)$r->id] = array(
                        'sheetId' => (int)$sheet['sheetId'],
                        'name' => (string)$sheet['name']
                    );
                }
                $workbookRelationsXML = simplexml_load_string($this->getEntryData($workbookDir . '_rels/' .
                    basename($rel['Target']) . '.rels'));
                foreach ($workbookRelationsXML->Relationship as $wrel) {
                    switch ($wrel['Type']) {
                        case self::SCHEMA_WORKSHEETRELATION:
                            $sheets[(string)$wrel['Id']]['path'] = $workbookDir . (string)$wrel['Target'];
                            break;
                        case self::SCHEMA_SHAREDSTRINGS:
                            $sharedStringsXML = simplexml_load_string(
                                $this->getEntryData($workbookDir . (string)$wrel['Target'])
                            );
                            foreach ($sharedStringsXML->si as $val) {
                                if (isset($val->t)) {
                                    $this->sharedStrings[] = (string)$val->t;
                                } elseif (isset($val->r)) {
                                    $this->sharedStrings[] = XLSXWorksheet::parseRichText($val);
                                }
                            }
                            break;
                    }
                }
            }
        }
        $this->sheetInfo = array();
        foreach ($sheets as $rid => $info) {
            $this->sheetInfo[$info['name']] = array(
                'sheetId' => $info['sheetId'],
                'rid' => $rid,
                'path' => $info['path']
            );
        }
    }

    // returns an array of sheet names, indexed by sheetId
    public function getSheetNames()
    {
        $res = array();
        foreach ($this->sheetInfo as $sheetName => $info) {
            $res[$info['sheetId']] = $sheetName;
        }
        return $res;
    }

    public function getSheetCount()
    {
        return count($this->sheetInfo);
    }

    // instantiates a sheet object (if needed) and returns an array of its data
    public function getSheetData($sheetNameOrId)
    {
        $sheet = $this->getSheet($sheetNameOrId);
        return $sheet->getData();
    }

    // instantiates a sheet object (if needed) and returns the sheet object
    public function getSheet($sheet)
    {
        if (is_numeric($sheet)) {
            $sheet = $this->getSheetNameById($sheet);
        } elseif (!is_string($sheet)) {
            throw new \Exception("Sheet must be a string or a sheet Id");
        }
        if (!array_key_exists($sheet, $this->sheets)) {
            $this->sheets[$sheet] = new XLSXWorksheet($this->getSheetXML($sheet), $sheet, $this);
        }
        return $this->sheets[$sheet];
    }

    public function getSheetNameById($sheetId)
    {
        foreach ($this->sheetInfo as $sheetName => $sheetInfo) {
            if ($sheetInfo['sheetId'] === $sheetId) {
                return $sheetName;
            }
        }
        throw new \Exception("Sheet ID $sheetId does not exist in the Excel file");
    }

    protected function getSheetXML($name)
    {
        return simplexml_load_string($this->getEntryData($this->sheetInfo[$name]['path']));
    }

    // converts an Excel date field (a number) to a unix timestamp (granularity: seconds)
    public static function toUnixTimeStamp($excelDateTime)
    {
        if (!is_numeric($excelDateTime)) {
            return $excelDateTime;
        }
        $d = floor($excelDateTime); // seconds since 1900
        $t = $excelDateTime - $d;
        return ($d > 0) ? ( $d - 25569 ) * 86400 + $t * 86400 : $t * 86400;
    }
}
