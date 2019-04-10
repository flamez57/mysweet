<?php
namespace application\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use application\services\exampleServices;

class IndexController extends HLController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
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
   </body>
</html>
HTML;
 $html = file_get_contents('http://tablesorter.com/docs/');
        $hta = new \hl\library\Tools\Html2Array\HLHtmlToArray($html);
        \hl\library\Functions\Helper::dump($hta->toJson());
        \hl\library\Functions\Helper::dump($hta->toArray());
        /**
 * Get html source from tablesorter.com
 */

/**
 * Print array of table rows for each table
 */
print_r($hta->getArrayOfTr());

/**
 * Print array of table columns for each table
 */
print_r($hta->getArrayOfTd(true));

/**
 * Print array of table headers for each table
 */
print_r($hta->getArrayOfTh(true));

/**
 * Returns array of tables
 *
 * @param bool $get_only_text (optional)
 * @return array
 */
print_r($hta->getArrayOfTables(false));
        $str = exampleServices::getInstance()->todo();
        //传递值到模板
        \hl\HLView::param('out', $str);
//        \hl\library\Functions\Helper::dump('sdf');  
    }
}
