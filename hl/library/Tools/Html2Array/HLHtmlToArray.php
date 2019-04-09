<?php

namespace hl\library\Tools\Html2Array;

use DOMDocument;

/**
** @ClassName: HLHtmlToArray
** @Description: HTML数据提取
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月9日 下午16:49
** @version V1.0
*/
class HLHtmlToArray
{
    /*
    ** 页面body体
    */
    private $body;

    /*
    ** 错误信息
    */
    private $errorMsg;

    /*
    ** @param $html string HTML页面代码
    */
    public function __construct($html)
    {
        //如果没有文档类型声明就加上
        if (false === mb_strpos(mb_strtolower(mb_substr($html, 0, 80)), '<!doctype') ) {
            $html = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body>{$html}</body></html>";
        }

        //实例化dom类
        $dom = new DOMDocument('1.0', 'UTF-8');

        //函数禁用标准的 libxml 错误，并启用用户错误处理。
        @libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        //函数清空 libxml 错误缓冲。
        @libxml_clear_errors();

        //根据标签获取元素
        $body = $dom->getElementsByTagName('body');
        if (0 == $body->length) {
            $this->errorMsg .= "body is null";
        }
        $this->body = $body[0];
    }
}
