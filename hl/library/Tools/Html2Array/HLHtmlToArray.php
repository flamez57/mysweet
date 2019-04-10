<?php

namespace hl\library\Tools\Html2Array;

use DOMDocument;
use DOMElement;

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
    ** 是否去除空格
    */
    protected $_removeEmptyStrings = true;

    /*
    ** 是否解析行内样式
    */
    protected $_parseCss = true;

    /*
    ** 转换成的数组
    */
    protected $_array = null;

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

    /**
    ** 转成联合数组
    ** @return array
    */
    public function toArray()
    {
        if (null === $this->_array) {
            $array = $this->_domElementToArray($this->body);
            if (empty($array) || !isset($array['children'])) {
                $this->_array = [];
            } else {
                $this->_array = $array['children'];
            }
        }
        return $this->_array;
    }

    /**
    ** HTML转JSON
    ** @return string
    */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
    ** 设置是否解析行内样式
    ** @param bool $value
    */
    public function parseCss($value = true)
    {
        $this->_parseCss = boolval($value);
    }

    /**
    ** 设置是否去除空格
    ** @param bool $value
    */
    public function removeEmptyStrings($value = true)
    {
        $this->_removeEmptyStrings = boolval($value);
    }

    /**
    ** 解析行内样式
    ** @param $css string style样式
    ** @return array
    */
    protected function _parseInlineCss($css)
    {
        $urls = [];
        // 修正了url()中“;”符号的问题
        $css = preg_replace_callback('/url(\s+)?\(.*\)/i', function ($match) use (&$urls) {
            $index = count($urls) + 1;
            $index = "%%$index%%";
            $urls[$index] = $match[0];
            return $index;
        }, $css);

        $arr = array_filter(array_map('trim', explode(';', $css)));

        $result = [];
        foreach ($arr as $item) {
            list ($attribute, $value) = array_map('trim', explode(':', $item));
            if (preg_match('/%%\d+%%/', $value)) {
                $value = preg_replace_callback('/%%\d+%%/', function ($match) use ($urls) {
                    if (isset($urls[$match[0]])) {
                        return $urls[$match[0]];
                    } else {
                        return $match[0];
                    }
                }, $value);
            }
            $result[$attribute] = $value;
        }
        return $result;
    }


    /**
    ** DOM对象转数组
    ** @param $element DOMElement
    ** @return array
    */
    protected function _domElementToArray(DOMElement $element)
    {
        $node = mb_strtolower($element->tagName);
        $attributes = [];
        foreach ($element->attributes as $attribute) {
            $attr = mb_strtolower($attribute->name);
            $value = $attribute->value;
            if ('style' == $attr && $this->_parseCss) {
                $value = $this->_parseInlineCss($value);
            }
            $attributes[$attr] = $value;
        }

        $children = [];
        if ($element->hasChildNodes()) {
            foreach ($element->childNodes as $childNode) {
                if (XML_ELEMENT_NODE === $childNode->nodeType) {
                    $children[] = $this->_domElementToArray($childNode);
                } elseif (XML_TEXT_NODE === $childNode->nodeType ) {
                    $text = $childNode->nodeValue;
                    if (!$this->_removeEmptyStrings || "" != trim($text)) {
                        $children[] = [
                            'node' => 'text',
                            'text' => $text
                        ];
                    }
                }
            }
        }

        $result = ['node' => $node];
        if (count($attributes) > 0) {
            $result['attributes'] = $attributes;
        }
        if (count($children) > 0) {
            $result['children'] = $children;
        }
        return $result;
    }

    /**
    ** 返回表格的数组
    ** @param $getOnlyText bool 是否只获取文本
    ** @return array
    */
    public function getArrayOfTables($getOnlyText = false)
    {
        return $this->getArrayByXPath('//table', $getOnlyText);
    }


    /**
    ** 返回表格的每一行
    ** @param $getOnlyText bool 是否只获取文本
    ** @return array
    */
    public function getArrayOfTr($getOnlyText = false)
    {
        $tablesArr = $this->getArrayByXPath('//table');
        $outArr = [];
        foreach ($tablesArr as $_ta) {
            $outArr[] = $this->getArrayByXPath('//tr', $getOnlyText, $_ta);
        }
        return $outArr;
    }


    /**
    ** 返回表格每一行的每一列
    ** @param $getOnlyText bool 是否只获取文本
    ** @return array
    */
    public function getArrayOfTd($getOnlyText = false)
    {
        $tableArr = $this->getArrayByXPath('//table');
        $outArr = [];
        foreach ($tableArr as $_k => $_ta) {
            $row = $this->getArrayByXPath('//tr', false, $_ta);
            foreach($row as $_rk => $_rv) {
                $parsedTd = $this->getArrayByXPath('//td', $getOnlyText, $_rv);
                if (!$parsedTd ) {
                    continue;
                }
                $outArr[$_k][$_rk] = $parsedTd;
            }
            unset($row);
        }
        return $outArr;
    }

    /**
    ** 返回表格的头
    ** @param $getOnlyText bool 是否只获取文本
    ** @return array
    */
    public function getArrayOfTh($getOnlyText = false)
    {
        $tableArr = $this->getArrayByXPath('//table');
        $outArr = [];
        foreach ($tableArr as $_k => $_ta) {
            $row = $this->getArrayByXPath('//tr', false, $_ta);
            foreach($row as $_rk => $_rv) {
                $parsedTh = $this->getArrayByXPath('//th', $getOnlyText, $_rv);
                if (!$parsedTh ) {
                    continue;
                }
                $outArr[$_k][$_rk] = $parsedTh;
            }
            unset($row);
        }
        return $outArr;
    }


    /**
    ** 解析器 基于DOMXpath
    ** @param $xPathString string //标签名
    ** @param  $getOnlyText bool 是否只获取文本
    ** @param $html string HTML代码
    ** @return array|null
    */
    private function getArrayByXPath($xPathString = null, $getOnlyText = false, $html = '')
    {
        if (!$xPathString) {
            return null;
        }
        if (!class_exists('\DOMXPath')) {
            $this->errorMsg .= "DOMXPath 扩展未开启";
            return [];
        }
        if (empty($html)) {
            $xPath = new \DOMXPath($this->dom);
        } else {
            $dom = new DOMDocument('1.0', 'UTF-8');
            //函数禁用标准的 libxml 错误，并启用用户错误处理。
            @libxml_use_internal_errors(true);
            $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$html);
            //函数清空 libxml 错误缓冲。
            @libxml_clear_errors();
            $xPath = new \DOMXPath($dom);
        }
        $outArr = [];
        foreach ($xPath->query($xPathString) as $item) {
            if ($getOnlyText) {
                $outArr[] = $item->textContent;
                continue;
            }
            if (empty($html)) {
                $outArr[] = $this->dom->saveHTML($item);
            } else {
                $outArr[] = $dom->saveHTML($item);
            }
        }
        return $outArr;
    }

    /*
    ** 获取错误信息
    */
    public function getErrorMsg()
    {
        return $this->errorMsg;
    }
}
