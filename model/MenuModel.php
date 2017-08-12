<?php

/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/7/2 20:58
 * Author: Flamez57 <1050355217@qq.com>
 */
class MenuModel extends Model
{
    public $tablename = 'menu';
    public $pk = 'id';
    
    public function getMenuList()
    {
        $datas = $this->getTopMenu();
        foreach ($datas as $_menuKey => $_menu) {
            $datas[$_menuKey]['children'] = $this->getMenuByParentId($_menu['id']);
            foreach ($datas[$_menuKey]['children'] as $__menuKey => $__menu) {
                $datas[$_menuKey]['children'][$__menuKey]['children'] = $this->getMenuByParentId($__menu['id']);
            }
        }
        return $datas;
    }
    
    private function getTopMenu()
    {
        $sql = "SELECT * FROM `hl_menu` WHERE parentId=0";
        return $this->fetchAll($sql);
    }
    
    private function getMenuByParentId($parentId)
    {
        $sql = "SELECT * FROM `hl_menu` WHERE parentId={$parentId}";
        return $this->fetchAll($sql);
    }
}
