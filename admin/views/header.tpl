<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=\hl\HLView::$putout['title']?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <?=\hl\HLView::componentsCss('bootstrap/dist/css/bootstrap.min.css');?>
        <!-- Font Awesome -->
        <?=\hl\HLView::componentsCss('font-awesome/css/font-awesome.min.css');?>
        <!-- Ionicons -->
        <?=\hl\HLView::componentsCss('Ionicons/css/ionicons.min.css');?>
        <!-- Theme style -->
        <?=\hl\HLView::css('AdminLTE.min.css');?>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <?=\hl\HLView::css('skins/_all-skins.min.css');?>
        <!-- Morris chart -->
        <?=\hl\HLView::componentsCss('morris.js/morris.css');?>
        <!-- jvectormap -->
        <?=\hl\HLView::componentsCss('jvectormap/jquery-jvectormap.css');?>
        <!-- Date Picker -->
        <?=\hl\HLView::componentsCss('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>
        <!-- Daterange picker -->
        <?=\hl\HLView::componentsCss('bootstrap-daterangepicker/daterangepicker.css');?>
        <!-- bootstrap wysihtml5 - text editor -->
        <?=\hl\HLView::pluginsCss('bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
