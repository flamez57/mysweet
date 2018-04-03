<?php
namespace hl;

use hl\HLSington;
/**
** @ClassName: HLView
** @Description: 视图基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月29日 晚上22:49
** @version V1.0
*/

class HLView extends HLSington
{
    /*
     * 
     */
    public function html()
    {
        var_dump(get_class(), $this, __FUNCTION__);
    }
    
    /*
     * js文件引入
     */
    public function js()
    {
        
    }
    
    /*
     * css文件引入
     */
    public function css()
    {
        
    }
    
    /*
     * 传入模板参数
     */
    public function param()
    {
        
    }
    
    /*
     * 引入模板
     */
    public function showTpl()
    {
        
    }
}