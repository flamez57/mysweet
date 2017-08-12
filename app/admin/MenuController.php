<?php

/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/7/2 17:05
 * Author: Flamez57 <1050355217@qq.com>
 */
class MenuController extends Controller
{
    ///index.php?m=admin&c=menu&a=menuList
    public function menuList()
    {
        $menu = new MenuModel;
        
        $data = $menu->getMenuList();

        echo Response::getInstance()->json(ErrorCode::SUCCESS, '', $data);
    }

}
