<?php
/**
 * ExcelDumper (http://www.dw-labs.de/ExcelDumper)
 *
 * @author     Daniel Wolkenhauer <dw@dwolke.de>
 * @copyright  Copyright (c) 2005-2015 Daniel Wolkenhauer
 * @link       http://github.com/dwolke/ExcelDumper
 * @version    0.1.1
 */

namespace hl\library\Tool\Excel;

/**
 * Helpers
 */
class ReaderUtil
{

    public static function getInt4d($data, $pos)
    {

        $value = ord($data[$pos]) | (ord($data[$pos + 1]) << 8) | (ord($data[$pos + 2]) << 16) | (ord($data[$pos + 3]) << 24);

        if ($value >= 4294967294) {
            $value = -2;
        }

        return $value;

    }

    public static function v($data, $pos)
    {
        return ord($data[$pos]) | ord($data[$pos + 1]) << 8;
    }

    /**
     * GetIEEE754
     *
     * @author chenmingming
     *
     * @param $num
     *
     * @return float|int
     */
    public static function GetIEEE754($num)
    {

        if (($num & 0x02) != 0) {
            $value = $num >> 2;
        } else {
            $sign     = ($num & 0x80000000) >> 31;
            $exp      = ($num & 0x7ff00000) >> 20;
            $mantissa = (0x100000 | ($num & 0x000ffffc));
            $value    = $mantissa / pow(2, (20 - ($exp - 1023)));
            if ($sign) {
                $value = -1 * $value;
            }
        }

        if (($num & 0x01) != 0) {
            $value /= 100;
        }

        return $value;
    }

    public static function gmGetDate($ts = null)
    {
        $k = [
            'seconds',
            'minutes',
            'hours',
            'mday',
            'wday',
            'mon',
            'year',
            'yday',
            'weekday',
            'month',
            0,
        ];

        return array_combine($k,
            explode(':',
                gmdate('s:i:G:j:w:n:Y:z:l:F:U', is_null($ts) ? time() : $ts)
            )
        );

    }

}
