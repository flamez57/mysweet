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
    ** DOM对象
    */
    private $dom;

    /*
    ** 错误信息
    */
    private $errorMsg;

    /*
    ** @param $html string HTML页面代码
    */
    public function __construct($html)
    {
        $html = $this->prepareForDOM($html);

        //实例化dom类
        $dom = new DOMDocument('1.0', 'UTF-8');

        //函数禁用标准的 libxml 错误，并启用用户错误处理。
        @libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        //函数清空 libxml 错误缓冲。
        @libxml_clear_errors();

        $this->dom = $dom;

        //根据标签获取元素
        $body = $dom->getElementsByTagName('body');
        if (0 == $body->length) {
            $this->errorMsg .= "body is null";
        }
        $this->body = $body[0];
    }

    /**
    ** 整理HTML代码
    ** @param $html string HTML代码
    ** @return string
    */
    private function prepareForDOM($html)
    {
        //获取当前字符串的编码
        $encoding = mb_detect_encoding($html, ["ASCII",'UTF-8',"GB2312","GBK",'BIG5']);
        if ($encoding != 'UTF-8') {
            $html = iconv($encoding, 'UTF-8//TRANSLIT', $html);
        }

        //如果没有文档类型声明就加上
        if (false === mb_strpos(mb_strtolower(mb_substr($html, 0, 80)), '<!doctype') ) {
            $html = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body>{$html}</body></html>";
        }

        //去除一些仅用于呈现的重要属性，如脚本、样式和其他标记。
        $html = preg_replace('/<(script|style|noscript)\b[^>]*>.*?<\/\1\b[^>]*>/is', '', $html);
        //整理HTML代码
        if (class_exists('\tidy')) {
            $tidy = new \tidy();
            $config = array(
                'drop-font-tags' => true,
                'drop-proprietary-attributes' => true,
                'hide-comments' => true,
                'indent' => true,
                'logical-emphasis' => true,
                'numeric-entities' => true,
                'output-xhtml' => true,
                'wrap' => 0
            );
            $tidy->parseString($html, $config, 'utf8');
            $tidy->cleanRepair();
            $html = $tidy->value;
        }
        //去除meta head
        $html = preg_replace('#<meta[^>]+>#isu', '', $html);
        $html = preg_replace(
            '#<head\b[^>]*>#isu',
            "<head>\r\n<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />",
            $html
        );
        return $html;
    }

    /**
    ** 获取 SimpleXMLElement 对象
    ** @return SimpleXMLElement|false
    */
    public function getXml()
    {
        return simplexml_import_dom($this->dom);
    }

    /**
    ** Get DOMDocument
    ** @return \DOMDocument
    */
    public function getDom()
    {
        return $this->dom;
    }

    /**
    ** Get array
    ** @return array
    */
    public function getArray()
    {
        return $this->xml2array($this->getXml());
    }

    /**
    ** SimpleXMLElement to array
    ** @param $xml SimpleXMLElement
    ** @return array
    */
    public function xml2array($xml)
    {
        $fils = 0;
        $tab = false;
        $array = [];
        foreach ($xml->children() as $key => $value) {
            $child = $this->xml2array($value);
            foreach ($value->attributes() as $ak => $av) {
                $tmp = (array) $av;
                $child[$ak] = $tmp;
            }
            /**
             * @var 返回直接位于此元素中的文本内容。不返回该元素子元素内部的文本内容。
             */
            $child['text'] = $value->__toString();
            if (strlen(trim($child['text'])) === 0) {
                unset($child['text']);
            }

            if ($tab == false && in_array($key, array_keys($array))) {
                //如果这个元素已经在数组中，我们将创建一个索引数组
                $tmp = $array[$key];
                $array[$key] = NULL;
                $array[$key][] = $tmp;
                $array[$key][] = $child;
                $tab = true;
            } elseif ($tab == true) {
                $array[$key][] = $child;
            } else {
                $array[$key] = $child;
            }
            $fils++;
        }

        if ($fils == 0) {
            return (array) $xml;
        }
        return $array;
    }
}
