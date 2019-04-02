<?php
/**
 * ExcelDumper (http://www.dw-labs.de/ExcelDumper)
 *
 * based on php-excel-reader2 (https://code.google.com/p/php-excel-reader2/)
 *
 * @author     Daniel Wolkenhauer <dw@dwolke.de>
 * @copyright  Copyright (c) 2005-2015 Daniel Wolkenhauer
 * @link       http://github.com/dwolke/ExcelDumper
 * @version    0.1.1
 */

namespace hl\library\Tools\Excel;


/**
 * parses the xls-file ...
 */
class XlsParser
{
    protected $data;
    const SPREADSHEET_EXCEL_READER_BIFF8 = 0x600;
    const SPREADSHEET_EXCEL_READER_BIFF7 = 0x500;
    const SPREADSHEET_EXCEL_READER_WORKBOOKGLOBALS = 0x5;
    const SPREADSHEET_EXCEL_READER_WORKSHEET = 0x10;
    const SPREADSHEET_EXCEL_READER_TYPE_BOF = 0x809;
    const SPREADSHEET_EXCEL_READER_TYPE_EOF = 0x0a;
    const SPREADSHEET_EXCEL_READER_TYPE_BOUNDSHEET = 0x85;
    const SPREADSHEET_EXCEL_READER_TYPE_DIMENSION = 0x200;
    const SPREADSHEET_EXCEL_READER_TYPE_ROW = 0x208;
    const SPREADSHEET_EXCEL_READER_TYPE_DBCELL = 0xd7;
    const SPREADSHEET_EXCEL_READER_TYPE_FILEPASS = 0x2f;
    const SPREADSHEET_EXCEL_READER_TYPE_NOTE = 0x1c;
    const SPREADSHEET_EXCEL_READER_TYPE_TXO = 0x1b6;
    const SPREADSHEET_EXCEL_READER_TYPE_RK = 0x7e;
    const SPREADSHEET_EXCEL_READER_TYPE_RK2 = 0x27e;
    const SPREADSHEET_EXCEL_READER_TYPE_MULRK = 0xbd;
    const SPREADSHEET_EXCEL_READER_TYPE_MULBLANK = 0xbe;
    const SPREADSHEET_EXCEL_READER_TYPE_INDEX = 0x20b;
    const SPREADSHEET_EXCEL_READER_TYPE_SST = 0xfc;
    const SPREADSHEET_EXCEL_READER_TYPE_EXTSST = 0xff;
    const SPREADSHEET_EXCEL_READER_TYPE_CONTINUE = 0x3c;
    const SPREADSHEET_EXCEL_READER_TYPE_LABEL = 0x204;
    const SPREADSHEET_EXCEL_READER_TYPE_LABELSST = 0xfd;
    const SPREADSHEET_EXCEL_READER_TYPE_NUMBER = 0x203;
    const SPREADSHEET_EXCEL_READER_TYPE_NAME = 0x18;
    const SPREADSHEET_EXCEL_READER_TYPE_ARRAY = 0x221;
    const SPREADSHEET_EXCEL_READER_TYPE_STRING = 0x207;
    const SPREADSHEET_EXCEL_READER_TYPE_FORMULA = 0x406;
    const SPREADSHEET_EXCEL_READER_TYPE_FORMULA2 = 0x6;
    const SPREADSHEET_EXCEL_READER_TYPE_FORMAT = 0x41e;
    const SPREADSHEET_EXCEL_READER_TYPE_XF = 0xe0;
    const SPREADSHEET_EXCEL_READER_TYPE_BOOLERR = 0x205;
    const SPREADSHEET_EXCEL_READER_TYPE_FONT = 0x0031;
    const SPREADSHEET_EXCEL_READER_TYPE_PALETTE = 0x0092;
    const SPREADSHEET_EXCEL_READER_TYPE_UNKNOWN = 0xffff;
    const SPREADSHEET_EXCEL_READER_TYPE_NINETEENFOUR = 0x22;
    const SPREADSHEET_EXCEL_READER_TYPE_MERGEDCELLS = 0xE5;
    const SPREADSHEET_EXCEL_READER_UTCOFFSETDAYS = 25569;
    const SPREADSHEET_EXCEL_READER_UTCOFFSETDAYS1904 = 24107;
    const SPREADSHEET_EXCEL_READER_MSINADAY = 86400;
    const SPREADSHEET_EXCEL_READER_TYPE_HYPER = 0x01b8;
    const SPREADSHEET_EXCEL_READER_TYPE_COLINFO = 0x7d;
    const SPREADSHEET_EXCEL_READER_TYPE_DEFCOLWIDTH = 0x55;
    const SPREADSHEET_EXCEL_READER_TYPE_STANDARDWIDTH = 0x99;
    const SPREADSHEET_EXCEL_READER_DEF_NUM_FORMAT = '%s';

    protected $defaultEncoding = 'UTF-8';
    protected $encoderFunction = '';
    protected $storeExtendedInfo = null;

    protected $oleStorage;
    protected $workbookData = null;

    protected $version = null;
    protected $nineteenFour = null;

    protected $boundsheets = null;
    protected $sn = null;
    protected $sheets = [];

    protected $sst = [];

    protected $formatRecords = null;
    protected $xfRecords = null;

    protected $defaultFormat = self::SPREADSHEET_EXCEL_READER_DEF_NUM_FORMAT;

    protected $colInfo = [];
    protected $rowInfo = [];

    protected $rowOffset = 1;
    protected $colOffset = 1;

    /**
     *
     * @var array
     */
    protected $dateFormats = [
        0xe  => 'm/d/Y',
        0xf  => 'M-d-Y',
        0x10 => 'd-M',
        0x11 => 'M-Y',
        0x12 => 'h:i a',
        0x13 => 'h:i:s a',
        0x14 => 'H:i',
        0x15 => 'H:i:s',
        0x16 => 'd/m/Y H:i',
        0x2d => 'i:s',
        0x2e => 'H:i:s',
        0x2f => 'i:s.S',
    ];

    protected $numberFormats = [
        0x1  => '0',
        0x2  => '0.00',
        0x3  => '#,##0',
        0x4  => '#,##0.00',
        0x5  => '\$#,##0;(\$#,##0)',
        0x6  => '\$#,##0;[Red](\$#,##0)',
        0x7  => '\$#,##0.00;(\$#,##0.00)',
        0x8  => '\$#,##0.00;[Red](\$#,##0.00)',
        0x9  => '0%',
        0xa  => '0.00%',
        0xb  => '0.00E+00',
        0x25 => '#,##0;(#,##0)',
        0x26 => '#,##0;[Red](#,##0)',
        0x27 => '#,##0.00;(#,##0.00)',
        0x28 => '#,##0.00;[Red](#,##0.00)',
        0x29 => '#,##0;(#,##0)', // unklar: Not exactly
        0x2a => '\$#,##0;(\$#,##0)', // unklar: Not exactly
        0x2b => '#,##0.00;(#,##0.00)', // unklar: Not exactly
        0x2c => '\$#,##0.00;(\$#,##0.00)', // unklar: Not exactly
        0x30 => '##0.0E+0',
    ];

    /**
     * Konstruktor
     *
     * @param string  $file              die einzulesende Datei
     * @param boolean $storeExtendedInfo unklar: erweiterte Infos ???
     * @param string  $outputEncoding    Zeichenkodierung der Ausgabe
     */
    public function __construct($file, $storeExtendedInfo = true, $outputEncoding = '')
    {

        $this->oleStorage      = new OleReader();
        $this->encoderFunction = $this->setUtfEncoder('iconv');

        if ($outputEncoding != '') {
            $this->setOutputEncoding($outputEncoding);
        }

        $this->storeExtendedInfo = $storeExtendedInfo;

        $this->read($file);

    }

    public function getSheets()
    {
        return $this->sheets;
    }

    /**
     * liest die xls-Datei mit OleReader, danach parsen
     *
     * @param string $file die zu lesende Datei
     */
    private function read($file)
    {

        $this->oleStorage->read($file);
        $this->workbookData = $this->oleStorage->getWorkbookData();
        $this->parseWorkbook();
    }

    /**
     * Parsen des Workbook-Streams
     *
     * @return boolean
     */
    private function parseWorkbook()
    {

        $pos  = 0;
        $data = $this->workbookData;

        $code          = ReaderUtil::v($data, $pos);
        $length        = ReaderUtil::v($data, $pos + 2);
        $version       = ReaderUtil::v($data, $pos + 4);
        $substreamType = ReaderUtil::v($data, $pos + 6);

        $this->version = $version;

        if (($version != self::SPREADSHEET_EXCEL_READER_BIFF8) && ($version != self::SPREADSHEET_EXCEL_READER_BIFF7)) {
            return false;
        }

        if ($substreamType != self::SPREADSHEET_EXCEL_READER_WORKBOOKGLOBALS) {
            return false;
        }

        $pos += $length + 4;

        $code   = ReaderUtil::v($data, $pos);
        $length = ReaderUtil::v($data, $pos + 2);

        while ($code != self::SPREADSHEET_EXCEL_READER_TYPE_EOF) {

            switch ($code) {

                case self::SPREADSHEET_EXCEL_READER_TYPE_SST:

                    $spos          = $pos + 4;
                    $limitpos      = $spos + $length;
                    $uniqueStrings = ReaderUtil::getInt4d($data, $spos + 4);
                    $spos          += 8;

                    for ($i = 0; $i < $uniqueStrings; $i++) {

                        // Read in the number of characters
                        if ($spos == $limitpos) {

                            $opcode    = ReaderUtil::v($data, $spos);
                            $conlength = ReaderUtil::v($data, $spos + 2);

                            if ($opcode != 0x3c) {
                                return -1;
                            }

                            $spos     += 4;
                            $limitpos = $spos + $conlength;

                        }

                        $numChars    = ord($data[$spos]) | (ord($data[$spos + 1]) << 8);
                        $spos        += 2;
                        $optionFlags = ord($data[$spos]);
                        $spos++;
                        $asciiEncoding  = (($optionFlags & 0x01) == 0);
                        $extendedString = (($optionFlags & 0x04) != 0);

                        // See if string contains formatting information
                        $richString = (($optionFlags & 0x08) != 0);

                        if ($richString) {
                            // Read in the crun
                            $formattingRuns = ReaderUtil::v($data, $spos);
                            $spos           += 2;
                        }

                        if ($extendedString) {
                            // Read in cchExtRst
                            $extendedRunLength = ReaderUtil::getInt4d($data, $spos);
                            $spos              += 4;
                        }

                        $len = ($asciiEncoding) ? $numChars : $numChars * 2;

                        if ($spos + $len < $limitpos) {

                            $retstr = substr($data, $spos, $len);
                            $spos   += $len;

                        } else {

                            // found countinue
                            $retstr    = substr($data, $spos, $limitpos - $spos);
                            $bytesRead = $limitpos - $spos;
                            $charsLeft = $numChars - (($asciiEncoding) ? $bytesRead : ($bytesRead / 2));
                            $spos      = $limitpos;

                            while ($charsLeft > 0) {

                                $opcode    = ReaderUtil::v($data, $spos);
                                $conlength = ReaderUtil::v($data, $spos + 2);

                                if ($opcode != 0x3c) {
                                    return -1;
                                }

                                $spos     += 4;
                                $limitpos = $spos + $conlength;
                                $option   = ord($data[$spos]);
                                $spos     += 1;

                                if ($asciiEncoding && ($option == 0)) {

                                    $len           = min($charsLeft, $limitpos - $spos); // min($charsLeft, $conlength);
                                    $retstr        .= substr($data, $spos, $len);
                                    $charsLeft     -= $len;
                                    $asciiEncoding = true;

                                } elseif (!$asciiEncoding && ($option != 0)) {

                                    $len           = min($charsLeft * 2, $limitpos - $spos); // min($charsLeft, $conlength);
                                    $retstr        .= substr($data, $spos, $len);
                                    $charsLeft     -= $len / 2;
                                    $asciiEncoding = false;

                                } elseif (!$asciiEncoding && ($option == 0)) {

                                    // Bummer - the string starts off as Unicode, but after the
                                    // continuation it is in straightforward ASCII encoding
                                    $len = min($charsLeft, $limitpos - $spos); // min($charsLeft, $conlength);

                                    for ($j = 0; $j < $len; $j++) {
                                        $retstr .= $data[$spos + $j] . chr(0);
                                    }

                                    $charsLeft     -= $len;
                                    $asciiEncoding = false;

                                } else {

                                    $newstr = '';

                                    for ($j = 0; $j < strlen($retstr); $j++) {
                                        $newstr = $retstr[$j] . chr(0);
                                    }

                                    $retstr        = $newstr;
                                    $len           = min($charsLeft * 2, $limitpos - $spos); // min($charsLeft, $conlength);
                                    $retstr        .= substr($data, $spos, $len);
                                    $charsLeft     -= $len / 2;
                                    $asciiEncoding = false;

                                }

                                $spos += $len;

                            }

                        }

                        if ($asciiEncoding) {
                            $retstr = preg_replace("/(.)/s", "$1\0", $retstr);
                        }

                        $retstr = $this->encodeUtf16($retstr);

                        if ($richString) {
                            $spos += 4 * $formattingRuns;
                        }

                        // For extended strings, skip over the extended string data
                        if ($extendedString) {
                            $spos += $extendedRunLength;
                        }

                        $this->sst[] = $retstr;

                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_FILEPASS:
                    return false;
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_NAME:
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_FORMAT:

                    $indexCode = ReaderUtil::v($data, $pos + 4);

                    if ($version == self::SPREADSHEET_EXCEL_READER_BIFF8) {

                        $numchars = ReaderUtil::v($data, $pos + 6);

                        if (ord($data[$pos + 8]) == 0) {
                            $formatString = substr($data, $pos + 9, $numchars);
                        } else {
                            $formatString = substr($data, $pos + 9, $numchars * 2);
                        }

                    } else {
                        $numchars     = ord($data[$pos + 6]);
                        $formatString = substr($data, $pos + 7, $numchars * 2);
                    }

                    $this->formatRecords[$indexCode] = $formatString;

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_FONT:
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_PALETTE:
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_XF:

                    $indexCode = ord($data[$pos + 6]) | ord($data[$pos + 7]) << 8;

                    $xf                = [];
                    $xf['formatIndex'] = $indexCode;

                    if (array_key_exists($indexCode, $this->dateFormats)) {

                        $xf['type']   = 'date';
                        $xf['format'] = $this->dateFormats[$indexCode];

                    } elseif (array_key_exists($indexCode, $this->numberFormats)) {

                        $xf['type']   = 'number';
                        $xf['format'] = $this->numberFormats[$indexCode];

                    } else {

                        $isdate    = false;
                        $formatstr = '';

                        if ($indexCode > 0) {

                            if (isset($this->formatRecords[$indexCode])) {
                                $formatstr = $this->formatRecords[$indexCode];
                            }

                            if ($formatstr != '') {

                                $tmp = preg_replace("/\;.*/", "", $formatstr);
                                $tmp = preg_replace("/^\[[^\]]*\]/", "", $tmp);

                                if (preg_match("/[^hmsday\/\-:\s\\\,AMP]/i", $tmp) == 0) { // found day/time format

                                    $isdate    = true;
                                    $formatstr = strtolower($tmp);

                                    $formatstr = str_replace('\\', '', $formatstr);

                                    $formatstr = trim(str_replace(['am/pm', 'mmmm', 'mmm'], ['', 'm', 'm'], $formatstr));

                                    // m/mm are used for both minutes and months - oh SNAP!
                                    // This mess tries to fix for that.
                                    // 'm' == minutes only if following h/hh or preceding s/ss
                                    $formatstr = preg_replace('/(h:?)mm?/', '$1i', $formatstr);
                                    $formatstr = preg_replace('/mm?(:?s)/', 'i$1', $formatstr);
                                    // $formatstr = preg_replace('/h{1,2}(:)/', 'h$1', $formatstr);
                                    // $formatstr = preg_replace('/(:)s{1,2}/', '$1s', $formatstr);

                                    // A single 'm' = n in PHP
                                    $formatstr = preg_replace('/(^|[^m])m([^m]|$)/', '$1n$2', $formatstr);
                                    $formatstr = preg_replace('/(^|[^m])m([^m]|$)/', '$1n$2', $formatstr);

                                    // else it's months
                                    $formatstr = str_replace('mm', 'm', $formatstr);

                                    // Convert single 'd' to 'j'
                                    $formatstr = preg_replace('/(^|[^d])d([^d]|$)/', '$1j$2', $formatstr);
                                    $formatstr = str_replace(['dddd', 'ddd', 'dd', 'yyyy', 'yy', 'hh', 'h'], ['l', 'D', 'd', 'Y', 'y', 'H', 'H'], $formatstr);
                                    $formatstr = preg_replace('/ss?/', 's', $formatstr);

                                    $formatstr = str_replace('/', '-', $formatstr);

                                }
                            }
                        }

                        if ($isdate) {

                            $xf['type']   = 'date';
                            $xf['format'] = $formatstr;

                        } else {

                            // kommt 0 oder # im format string vor, nehmen wir mal ein zahl an
                            if (preg_match("/[0#]/", $formatstr)) {
                                $xf['type'] = 'number';
                            } else {
                                $xf['type'] = 'other';
                            }

                            $xf['format'] = $formatstr;
                            $xf['code']   = $indexCode;

                        }

                    }

                    $this->xfRecords[] = $xf;
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_NINETEENFOUR:
                    $this->nineteenFour = (ord($data[$pos + 4]) == 1);
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_BOUNDSHEET:

                    $rec_offset         = ReaderUtil::getInt4d($data, $pos + 4);
                    $rec_typeFlag       = ord($data[$pos + 8]);
                    $rec_visibilityFlag = ord($data[$pos + 9]);
                    $rec_length         = ord($data[$pos + 10]);

                    if ($version == self::SPREADSHEET_EXCEL_READER_BIFF8) {

                        $chartype = ord($data[$pos + 11]);

                        if ($chartype == 0) {
                            $rec_name = substr($data, $pos + 12, $rec_length);
                        } else {
                            $rec_name = $this->encodeUtf16(substr($data, $pos + 12, $rec_length * 2));
                        }

                    } elseif ($version == self::SPREADSHEET_EXCEL_READER_BIFF7) {
                        $rec_name = substr($data, $pos + 11, $rec_length);
                    }
                    $this->boundsheets[] = ['name' => $rec_name, 'offset' => $rec_offset];
                    break;

            }

            $pos    += $length + 4;
            $code   = ord($data[$pos]) | ord($data[$pos + 1]) << 8;
            $length = ord($data[$pos + 2]) | ord($data[$pos + 3]) << 8;

        }

        foreach ($this->boundsheets as $key => $val) {
            $this->sn = $key;
            $this->parseSheet($val['offset']);
        }

        return true;

    }

    private function parseSheet($spos)
    {

        $cont = true;
        $data = $this->workbookData;

        // read BOF
        $code   = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
        $length = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;

        $version       = ord($data[$spos + 4]) | ord($data[$spos + 5]) << 8;
        $substreamType = ord($data[$spos + 6]) | ord($data[$spos + 7]) << 8;

        if (($version != self::SPREADSHEET_EXCEL_READER_BIFF8) && ($version != self::SPREADSHEET_EXCEL_READER_BIFF7)) {
            return -1;
        }

        if ($substreamType != self::SPREADSHEET_EXCEL_READER_WORKSHEET) {
            return -2;
        }

        $spos += $length + 4;

        while ($cont) {

            $lowcode = ord($data[$spos]);

            if ($lowcode == self::SPREADSHEET_EXCEL_READER_TYPE_EOF)
                break;

            $code   = $lowcode | ord($data[$spos + 1]) << 8;
            $length = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
            $spos   += 4;

            $this->sheets[$this->sn]['maxrow'] = $this->rowOffset - 1;
            $this->sheets[$this->sn]['maxcol'] = $this->colOffset - 1;

            unset($this->rectype);

            switch ($code) {

                case self::SPREADSHEET_EXCEL_READER_TYPE_DIMENSION:

                    if (!isset($this->numRows)) {

                        if (($length == 10) || ($version == self::SPREADSHEET_EXCEL_READER_BIFF7)) {

                            $this->sheets[$this->sn]['numRows'] = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                            $this->sheets[$this->sn]['numCols'] = ord($data[$spos + 6]) | ord($data[$spos + 7]) << 8;

                        } else {

                            $this->sheets[$this->sn]['numRows'] = ord($data[$spos + 4]) | ord($data[$spos + 5]) << 8;
                            $this->sheets[$this->sn]['numCols'] = ord($data[$spos + 10]) | ord($data[$spos + 11]) << 8;

                        }

                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_MERGEDCELLS:

                    $cellRanges = ord($data[$spos]) | ord($data[$spos + 1]) << 8;

                    for ($i = 0; $i < $cellRanges; $i++) {

                        $fr = ord($data[$spos + 8 * $i + 2]) | ord($data[$spos + 8 * $i + 3]) << 8;
                        $lr = ord($data[$spos + 8 * $i + 4]) | ord($data[$spos + 8 * $i + 5]) << 8;
                        $fc = ord($data[$spos + 8 * $i + 6]) | ord($data[$spos + 8 * $i + 7]) << 8;
                        $lc = ord($data[$spos + 8 * $i + 8]) | ord($data[$spos + 8 * $i + 9]) << 8;

                        if ($lr - $fr > 0) {
                            $this->sheets[$this->sn]['cellsInfo'][$fr + 1][$fc + 1]['rowspan'] = $lr - $fr + 1;
                        }

                        if ($lc - $fc > 0) {
                            $this->sheets[$this->sn]['cellsInfo'][$fr + 1][$fc + 1]['colspan'] = $lc - $fc + 1;
                        }

                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_RK:
                case self::SPREADSHEET_EXCEL_READER_TYPE_RK2:

                    $row      = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column   = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $rknum    = ReaderUtil::getInt4d($data, $spos + 6);
                    $numValue = ReaderUtil::GetIEEE754($rknum);
                    $info     = $this->getCellDetails($spos, $numValue, $column);
                    $this->addCell($row, $column, $info['string'], $info);

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_LABELSST:

                    $row     = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column  = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $xfindex = ord($data[$spos + 4]) | ord($data[$spos + 5]) << 8;
                    $index   = ReaderUtil::getInt4d($data, $spos + 6);
                    $this->addCell($row, $column, $this->sst[$index], ['xfIndex' => $xfindex]);

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_MULRK:

                    $row      = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $colFirst = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $colLast  = ord($data[$spos + $length - 2]) | ord($data[$spos + $length - 1]) << 8;
                    $columns  = $colLast - $colFirst + 1;
                    $tmppos   = $spos + 4;

                    for ($i = 0; $i < $columns; $i++) {
                        $numValue = ReaderUtil::GetIEEE754(ReaderUtil::getInt4d($data, $tmppos + 2));
                        $info     = $this->getCellDetails($tmppos - 4, $numValue, $colFirst + $i + 1);
                        $tmppos   += 6;
                        // $this->addcell($row, $colFirst + $i, $info['string'], $info);
                        $this->addCell($row, $colFirst + $i, $info['raw'], $info);
                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_NUMBER:

                    $row    = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $tmp    = unpack("ddouble", substr($data, $spos + 6, 8)); // It machine machine dependent

                    if ($this->isDate($spos)) {
                        $numValue = $tmp['double'];
                    } else {
                        $numValue = $this->createNumber($spos);
                    }

                    $info = $this->getCellDetails($spos, $numValue, $column);
                    //$this->addcell($row, $column, $info['raw'], $info);
                    $this->addCell($row, $column, $info['string'], $info);

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_FORMULA:
                case self::SPREADSHEET_EXCEL_READER_TYPE_FORMULA2:

                    $row    = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;

                    if ((ord($data[$spos + 6]) == 0) && (ord($data[$spos + 12]) == 255) && (ord($data[$spos + 13]) == 255)) {

                        //String formula. Result follows in a STRING record
                        // This row/col are stored to be referenced in that record
                        // http://code.google.com/p/php-excel-reader/issues/detail?id=4
                        $previousRow = $row;
                        $previousCol = $column;

                    } elseif ((ord($data[$spos + 6]) == 1) && (ord($data[$spos + 12]) == 255) && (ord($data[$spos + 13]) == 255)) {

                        //Boolean formula. Result is in +2; 0=false,1=true
                        // http://code.google.com/p/php-excel-reader/issues/detail?id=4
                        if (ord($this->data[$spos + 8]) == 1) {
                            $this->addCell($row, $column, 'TRUE');
                        } else {
                            $this->addCell($row, $column, 'FALSE');
                        }

                    } elseif ((ord($data[$spos + 6]) == 2) && (ord($data[$spos + 12]) == 255) && (ord($data[$spos + 13]) == 255)) {
                        //Error formula. Error code is in +2;
                    } elseif ((ord($data[$spos + 6]) == 3) && (ord($data[$spos + 12]) == 255) && (ord($data[$spos + 13]) == 255)) {
                        //Formula result is a null string.
                        $this->addCell($row, $column, '');
                    } else {

                        // result is a number, so first 14 bytes are just like a _NUMBER record
                        $tmp = unpack("ddouble", substr($data, $spos + 6, 8)); // It machine machine dependent

                        if ($this->isDate($spos)) {
                            $numValue = $tmp['double'];
                        } else {
                            $numValue = $this->createNumber($spos);
                        }

                        $info = $this->getCellDetails($spos, $numValue, $column);
                        // $this->addcell($row, $column, $info ['string'], $info);
                        $this->addCell($row, $column, $info ['raw'], $info);

                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_BOOLERR:

                    $row    = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $string = ord($data[$spos + 6]);
                    $this->addCell($row, $column, $string);

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_STRING:

                    // http://code.google.com/p/php-excel-reader/issues/detail?id=4
                    if ($version == self::SPREADSHEET_EXCEL_READER_BIFF8) {

                        // Unicode 16 string, like an SST record
                        $xpos        = $spos;
                        $numChars    = ord($data[$xpos]) | (ord($data[$xpos + 1]) << 8);
                        $xpos        += 2;
                        $optionFlags = ord($data[$xpos]);
                        $xpos++;

                        $asciiEncoding  = (($optionFlags & 0x01) == 0);
                        $extendedString = (($optionFlags & 0x04) != 0);

                        // See if string contains formatting information
                        $richString = (($optionFlags & 0x08) != 0);

                        if ($richString) {
                            // Read in the crun
                            $formattingRuns = ord($data[$xpos]) | (ord($data[$xpos + 1]) << 8);
                            $xpos           += 2;
                        }

                        if ($extendedString) {
                            // Read in cchExtRst
                            $extendedRunLength = ReaderUtil::getInt4d($this->data, $xpos);
                            $xpos              += 4;
                        }

                        $len    = ($asciiEncoding) ? $numChars : $numChars * 2;
                        $retstr = substr($data, $xpos, $len);
                        $xpos   += $len;

                        if ($asciiEncoding) {
                            $retstr = preg_replace("/(.)/s", "$1\0", $retstr);
                        }

                        $retstr = $this->encodeUtf16($retstr);

                    } elseif ($version == self::SPREADSHEET_EXCEL_READER_BIFF7) {

                        // Simple byte string
                        $xpos     = $spos;
                        $numChars = ord($data[$xpos]) | (ord($data[$xpos + 1]) << 8);
                        $xpos     += 2;
                        $retstr   = substr($data, $xpos, $numChars);

                    }

                    $this->addCell($previousRow, $previousCol, $retstr);

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_ROW:

                    $row     = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $rowInfo = ord($data[$spos + 6]) | ((ord($data[$spos + 7]) << 8) & 0x7FFF);

                    if (($rowInfo & 0x8000) > 0) {
                        $rowHeight = -1;
                    } else {
                        $rowHeight = $rowInfo & 0x7FFF;
                    }

                    $rowHidden                          = (ord($data[$spos + 12]) & 0x20) >> 5;
                    $this->rowInfo[$this->sn][$row + 1] = ['height' => $rowHeight / 20, 'hidden' => $rowHidden];

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_DBCELL:
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_MULBLANK:

                    $row    = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $cols   = ($length / 2) - 3;

                    for ($c = 0; $c < $cols; $c++) {
                        $xfindex = ord($data[$spos + 4 + ($c * 2)]) | ord($data[$spos + 5 + ($c * 2)]) << 8;
                        $this->addCell($row, $column + $c, '', ['xfIndex' => $xfindex]);
                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_LABEL:

                    $row    = ord($data[$spos]) | ord($data[$spos + 1]) << 8;
                    $column = ord($data[$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $this->addCell($row, $column, substr($data, $spos + 8, ord($data[$spos + 6]) | ord($data[$spos + 7]) << 8));

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_EOF:
                    $cont = false;
                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_HYPER:

                    // Only handle hyperlinks to a URL
                    $row  = ord($this->data[$spos]) | ord($this->data[$spos + 1]) << 8;
                    $row2 = ord($this->data[$spos + 2]) | ord($this->data[$spos + 3]) << 8;

                    $column  = ord($this->data[$spos + 4]) | ord($this->data[$spos + 5]) << 8;
                    $column2 = ord($this->data[$spos + 6]) | ord($this->data[$spos + 7]) << 8;

                    $linkdata = [];

                    $flags             = ord($this->data[$spos + 28]);
                    $udesc             = '';
                    $ulink             = '';
                    $uloc              = 32;
                    $linkdata['flags'] = $flags;

                    if (($flags & 1) > 0) { // is a type we understand

                        //  is there a description ?
                        if (($flags & 0x14) == 0x14) { // has a description
                            $uloc    += 4;
                            $descLen = ord($this->data[$spos + 32]) | ord($this->data[$spos + 33]) << 8;
                            $udesc   = substr($this->data, $spos + $uloc, $descLen * 2);
                            $uloc    += 2 * $descLen;
                        }

                        $ulink = $this->read16bitstring($this->data, $spos + $uloc + 20);

                        if ($udesc == '') {
                            $udesc = $ulink;
                        }

                    }

                    $linkdata['desc'] = $udesc;
                    $linkdata['link'] = $this->encodeUtf16($ulink);

                    for ($r = $row; $r <= $row2; $r++) {

                        for ($c = $column; $c <= $column2; $c++) {
                            $this->sheets[$this->sn]['cellsInfo'][$r + 1][$c + 1]['hyperlink'] = $linkdata;
                        }

                    }

                    break;

                case self::SPREADSHEET_EXCEL_READER_TYPE_DEFCOLWIDTH:
                case self::SPREADSHEET_EXCEL_READER_TYPE_STANDARDWIDTH:
                case self::SPREADSHEET_EXCEL_READER_TYPE_COLINFO:

                    $colfrom = ord($data[$spos + 0]) | ord($data[$spos + 1]) << 8;
                    $colto   = ord($data [$spos + 2]) | ord($data[$spos + 3]) << 8;
                    $cw      = ord($data[$spos + 4]) | ord($data[$spos + 5]) << 8;
                    $cxf     = ord($data[$spos + 6]) | ord($data[$spos + 7]) << 8;
                    $co      = ord($data[$spos + 8]);

                    for ($coli = $colfrom; $coli <= $colto; $coli++) {
                        $this->colInfo[$this->sn][$coli + 1] = ['width' => $cw, 'xf' => $cxf, 'hidden' => ($co & 0x01), 'collapsed' => ($co & 0x1000) >> 12];
                    }

                    break;

                default:
                    break;

            }

            $spos += $length;

        }

        if (!isset($this->sheets[$this->sn]['numRows'])) {
            $this->sheets[$this->sn]['numRows'] = $this->sheets[$this->sn]['maxrow'];
        }

        if (!isset($this->sheets[$this->sn]['numCols'])) {
            $this->sheets[$this->sn]['numCols'] = $this->sheets[$this->sn]['maxcol'];
        }

    }

    private function isDate($spos)
    {
        $xfindex = ord($this->workbookData[$spos + 4]) | ord($this->workbookData[$spos + 5]) << 8;

        return ($this->xfRecords[$xfindex]['type'] == 'date');
    }

    private function createNumber($spos)
    {

        $rknumhigh = ReaderUtil::getInt4d($this->workbookData, $spos + 10);
        $rknumlow  = ReaderUtil::getInt4d($this->workbookData, $spos + 6);

        $sign = ($rknumhigh & 0x80000000) >> 31;
        $exp  = ($rknumhigh & 0x7ff00000) >> 20;

        $mantissa     = (0x100000 | ($rknumhigh & 0x000fffff));
        $mantissalow1 = ($rknumlow & 0x80000000) >> 31;
        $mantissalow2 = ($rknumlow & 0x7fffffff);

        $value = $mantissa / pow(2, (20 - ($exp - 1023)));

        if ($mantissalow1 != 0) {
            $value += 1 / pow(2, (21 - ($exp - 1023)));
        }

        $value += $mantissalow2 / pow(2, (52 - ($exp - 1023)));

        if ($sign) {
            $value = -1 * $value;
        }

        return $value;

    }

    private function getCellDetails($spos, $numValue, $column)
    {

        $xfindex  = ord($this->workbookData[$spos + 4]) | ord($this->workbookData[$spos + 5]) << 8;
        $xfrecord = $this->xfRecords[$xfindex];
        $type     = $xfrecord['type'];

        $format      = $xfrecord['format'];
        $formatIndex = $xfrecord['formatIndex'];
        $rectype     = '';
        $string      = '';
        $raw         = '';

        if (isset($this->_columnsFormat[$column + 1])) {
            $format = $this->_columnsFormat[$column + 1];
        }

        if ($type == 'date') {

            $rectype = 'date';

            // Convert numeric value into a date
            $utcDays  = floor($numValue - ($this->nineteenFour ? self::SPREADSHEET_EXCEL_READER_UTCOFFSETDAYS1904 : self::SPREADSHEET_EXCEL_READER_UTCOFFSETDAYS));
            $utcValue = ($utcDays) * self::SPREADSHEET_EXCEL_READER_MSINADAY;
            $dateinfo = ReaderUtil::gmGetDate($utcValue);

            $raw           = $numValue;
            $fractionalDay = $numValue - floor($numValue) + .0000001; // The .0000001 is to fix for php/excel fractional diffs

            $totalseconds = floor(self::SPREADSHEET_EXCEL_READER_MSINADAY * $fractionalDay);
            $secs         = $totalseconds % 60;
            $totalseconds -= $secs;
            $hours        = floor($totalseconds / (60 * 60));
            $mins         = floor($totalseconds / 60) % 60;

            $fmt    = 'Y-m-d H:i:s';
            $string = date($fmt, mktime($hours, $mins, $secs, $dateinfo["mon"], $dateinfo["mday"], $dateinfo["year"]));

        } elseif ($type == 'number') {

            $rectype   = 'number';
            $formatted = $this->formatValue($format, $numValue, $formatIndex);
            $string    = $formatted['string'];

            $raw = $numValue;

        } else {

            if ($format == '') {
                $format = $this->defaultFormat;
            }

            $rectype   = 'unknown';
            $formatted = $this->formatValue($format, $numValue, $formatIndex);
            $string    = $formatted['string'];
            $raw       = $numValue;

        }

        $ret = [
            'string'      => $string,
            'raw'         => $raw,
            'rectype'     => $rectype,
            'format'      => $format,
            'formatIndex' => $formatIndex,
            'xfIndex'     => $xfindex,
        ];

        return $ret;

    }

    private function addCell($row, $col, $string, $info = null)
    {

        $this->sheets[$this->sn]['maxrow']                                                  = max($this->sheets[$this->sn]['maxrow'], $row + $this->rowOffset);
        $this->sheets[$this->sn]['maxcol']                                                  = max($this->sheets[$this->sn]['maxcol'], $col + $this->colOffset);
        $this->sheets[$this->sn]['cells'][$row + $this->rowOffset][$col + $this->colOffset] = $string;

        if ($this->storeExtendedInfo && $info) {

            foreach ($info as $key => $val) {
                $this->sheets[$this->sn]['cellsInfo'][$row + $this->rowOffset][$col + $this->colOffset][$key] = $val;
            }

        }

    }

    private function formatValue($format, $num, $f)
    {

        // 49==TEXT format
        // http://code.google.com/p/php-excel-reader/issues/detail?id=7
        if ((!$f && $format == "%s") || ($f == 49) || ($format == "GENERAL")) {
            return ['string' => $num];
        }

        // Custom pattern can be POSITIVE;NEGATIVE;ZERO
        // The "text" option as 4th parameter is not handled
        $parts   = explode(";", $format);
        $pattern = $parts[0];

        // Negative pattern
        if (count($parts) > 2 && $num == 0) {
            $pattern = $parts[2];
        }

        // Zero pattern
        if (count($parts) > 1 && $num < 0) {
            $pattern = $parts[1];
            $num     = abs($num);
        }

        $matches = [];

        // In Excel formats, "_" is used to add spacing, which we can't do in HTML
        $pattern = preg_replace("/_./", "", $pattern);

        // Some non-number characters are escaped with \, which we don't need
        $pattern = preg_replace("/\\\/", "", $pattern);

        // Some non-number strings are quoted, so we'll get rid of the quotes
        $pattern = preg_replace("/\"/", "", $pattern);

        // TEMPORARY - Convert # to 0
        $pattern = preg_replace("/\#/", "0", $pattern);

        // Find out if we need comma formatting
        $has_commas = preg_match("/,/", $pattern);

        if ($has_commas) {
            $pattern = preg_replace("/,/", "", $pattern);
        }

        // Handle Percentages
        if (preg_match("/\d(\%)([^\%]|$)/", $pattern, $matches)) {
            $num     = $num * 100;
            $pattern = preg_replace("/(\d)(\%)([^\%]|$)/", "$1%$3", $pattern);
        }

        // Handle the number itself
        $number_regex = "/(\d+)(\.?)(\d*)/";

        if (preg_match($number_regex, $pattern, $matches)) {
            $left  = $matches[1];
            $dec   = $matches[2];
            $right = $matches[3];

            if ($has_commas) {
                $formatted = number_format($num, strlen($right));
            } else {
                $sprintf_pattern = "%1." . strlen($right) . "f";
                $formatted       = sprintf($sprintf_pattern, $num);
            }

            $pattern = preg_replace($number_regex, $formatted, $pattern);

        }

        return [
            'string' => $pattern,
        ];

    }

    private function encodeUtf16($string)
    {

        $result = $string;

        if ($this->defaultEncoding) {

            switch ($this->encoderFunction) {

                case 'iconv':
                    $result = iconv('UTF-16LE', $this->defaultEncoding, $string);
                    break;

                case 'mb_convert_encoding':
                    $result = mb_convert_encoding($string, $this->defaultEncoding, 'UTF-16LE');
                    break;

            }

        }

        return $result;

    }

    /**
     * legt fest, welche Funktionen für die Umwandlung der UTF-16LE-Kodierung
     * verwendet werden sollen.
     *
     * @param string $encoder 'iconv' or 'mb'
     */
    private function setUtfEncoder($encoder = 'iconv')
    {

        if ($encoder == 'iconv') {
            return function_exists('iconv') ? 'iconv' : '';
        } elseif ($encoder == 'mb') {
            return function_exists('mb_convert_encoding') ? 'mb_convert_encoding' : '';
        }

    }

    /**
     * setzt die Standard-Zeichenkodierung für die Ausgabe
     *
     * @param string $encoding Kodierung
     */
    private function setOutputEncoding($encoding)
    {
        $this->defaultEncoding = $encoding;
    }

}

