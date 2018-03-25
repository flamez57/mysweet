<?php
namespace application;

use hl\HLBootstrap;

class Bootstrap extends HLBootstrap
{
    public function __construct()
    {
        parent::init();
    }
//	public function HLinitConfig()
//	{
//		//把配置保存起来
//	}
//
//	public function HLinitPlugin()
//	{
//		//注册一个插件
//	}
//
//	public function HLinitRoute()
//	{
//		//在这里注册自己的路由协议,默认使用简单路由
//	}
//
//	public function HLinitView()
//	{
//		//在这里注册自己的view控制器，例如smarty,firekylin
//	}
    
    public function run()
    {
        echo 'ok';
    }
}