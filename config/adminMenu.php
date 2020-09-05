<?php

return [
    [
        'menu_id' => 0,
        'name' => '企业站',
        'children' => [
            [
                'name' => '轮播',
                'code' => 'kzq', //控制器
                'children' => [
                    ['name' => '菜单1', 'code' => 'fangfa1'/*方法*/],
                    ['name' => '菜单2', 'code' => 'fangfa2'/*方法*/],
                    ['name' => '菜单3', 'code' => 'fangfa3'/*方法*/],
                ]
            ],[
                'name' => '轮播2',
                'code' => 'kzq', //控制器
                'children' => [
                    ['name' => '菜单11', 'code' => 'fangfa11'/*方法*/],
                    ['name' => '菜单22', 'code' => 'fangfa22'/*方法*/],
                    ['name' => '菜单33', 'code' => 'fangfa33'/*方法*/],
                ]
            ]
        ]
    ],[
        'menu_id' => 1,
        'name' => '博客',
        'children' => [],
    ],[
        'menu_id' => 2,
        'name' => '手机商城',
        'children' => [],
    ],[
        'menu_id' => 3,
        'name' => 'pc商城',
        'children' => [],
    ],[
        'menu_id' => 4,
        'name' => '分销商城',
        'children' => [],
    ]
];
