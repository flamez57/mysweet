<!DOCTYPE html>
<html>
<head>
	<title>首页模板</title>
</head>
<body>
    <div><a href="<?=\hl\HLRoute::makeUrl('application', 'index', 'index')?>">hello world!</a></div>
    <div><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'index')?>">企业站!</a></div>
    <div><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'index')?>">博客</a></div>
        <?=\hl\HlView::$putout['out']?>
        <?php
        for($i=0;$i<=25;$i++){
            \hl\HLView::img('640 ('.$i.').webp', ['width' => '200px']);
        }
        for($i=0;$i<=20;$i++){
            \hl\HLView::img('jpg'.DIRECTORY_SEPARATOR.$i.'.jpg', ['width' => '200px']);
        }
        ?>
</body>
</html>