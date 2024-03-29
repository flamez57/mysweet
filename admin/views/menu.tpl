<!--左侧菜单-->
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?=\hl\HLView::img('user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']);?>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['index', 'index2'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'index') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'index', 'index')?>"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'index2') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'index', 'index2')?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['topNav', 'boxed', 'fixed', 'collapsedSidebar'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Layout Options</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'topNav') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'topNav')?>"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'boxed') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'boxed')?>"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'fixed') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'fixed')?>"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'collapsedSidebar') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'collapsedSidebar')?>"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                </ul>
            </li>
            <?php foreach (\hl\HLView::$putout['left_menu'] as $_v) { if (isset($_v['children'])) { ?>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], array_column($_v['children'], 'code'))) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span><?=$_v['name'];?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php foreach ($_v['children'] as $__v) { ?>
                    <li<?php if (\hl\HLView::$putout['active'] == $__v['code']) {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', $_v['code'], $__v['code'])?>"><i class="fa fa-circle-o"></i> <?=$__v['name'];?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="#">
                    <i class="fa fa-th"></i> <span><?=$_v['name'];?></span>
                </a>
            </li>
            <?php } } ?>
            <li>
                <a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'widgets')?>">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['chartjs', 'morris', 'flot', 'inline'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'chartjs') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'chartjs')?>"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'morris') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'morris')?>"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'flot') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'flot')?>"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'inline') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'inline')?>"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['general2', 'icons', 'buttons', 'sliders', 'timeline', 'modals'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>UI Elements</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'general2') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'general2')?>"><i class="fa fa-circle-o"></i> General</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'icons') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'icons')?>"><i class="fa fa-circle-o"></i> Icons</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'buttons') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'buttons')?>"><i class="fa fa-circle-o"></i> Buttons</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'sliders') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'sliders')?>"><i class="fa fa-circle-o"></i> Sliders</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'timeline') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'timeline')?>"><i class="fa fa-circle-o"></i> Timeline</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'modals') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'modals')?>"><i class="fa fa-circle-o"></i> Modals</a></li>
                </ul>
            </li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['general', 'advanced', 'editors'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Forms</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'general') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'general')?>"><i class="fa fa-circle-o"></i> General Elements</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'advanced') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'advanced')?>"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'editors') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'editors')?>"><i class="fa fa-circle-o"></i> Editors</a></li>
                </ul>
            </li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['simple', 'data'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'simple') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'simple')?>"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'data') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'data')?>"><i class="fa fa-circle-o"></i> Data tables</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'calendar')?>">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'mailbox')?>">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-yellow">12</small>
                        <small class="label pull-right bg-green">16</small>
                        <small class="label pull-right bg-red">5</small>
                    </span>
                </a>
            </li>
            <li class="<?php if (in_array(\hl\HLView::$putout['active'], ['invoice', 'profile', 'login', 'register', 'lockscreen', '_404', '_500', 'blank', 'pace'])) {echo 'active ';}?>treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li<?php if (\hl\HLView::$putout['active'] == 'invoice') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'invoice')?>"><i class="fa fa-circle-o"></i> Invoice</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'profile') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'profile')?>"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'login') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'login')?>"><i class="fa fa-circle-o"></i> Login</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'register') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'register')?>"><i class="fa fa-circle-o"></i> Register</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'lockscreen') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'lockscreen')?>"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == '_404') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', '_404')?>"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == '_500') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', '_500')?>"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'blank') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'blank')?>"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    <li<?php if (\hl\HLView::$putout['active'] == 'pace') {echo ' class="active"';}?>><a href="<?=\hl\HLRoute::makeUrl('admin', 'pages', 'pace')?>"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Level One
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>
            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
