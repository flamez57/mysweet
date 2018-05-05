<!DOCTYPE html>
<html>
	<head>
		<title>Black &amp; White</title>

		<!-- meta -->
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- css -->
        <?=\hl\HLView::css('bootstrap.min.css');?>
		<!-- <?=\hl\HLView::css('ionicons.min.css');?> -->
        <?=\hl\HLView::css('pace.css');?>
        <?=\hl\HLView::css('custom.css');?>

	    <!-- js -->
        <?=\hl\HLView::js('jquery-2.1.3.min.js');?>
        <?=\hl\HLView::js('bootstrap.min.js');?>
        <?=\hl\HLView::js('pace.min.js');?>
        <?=\hl\HLView::js('modernizr.custom.js');?>
	</head>

	<body>
		<div class="container">	
			<header id="site-header">
				<div class="row">
					<div class="col-md-4 col-sm-5 col-xs-8">
						<div class="logo">
							<h1><a href="index.html"><b>☯</b> &amp; hl</a></h1>
						</div>
					</div><!-- col-md-4 -->
					<div class="col-md-8 col-sm-7 col-xs-4">
						<nav class="main-nav" role="navigation">
							<div class="navbar-header">
  								<button type="button" id="trigger-overlay" class="navbar-toggle">
    								<span class="ion-navicon"></span>
  								</button>
							</div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  								<ul class="nav navbar-nav navbar-right">
    								<li class="cl-effect-11"><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'index')?>" data-hover="Home">Home</a></li>
    								<li class="cl-effect-11"><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'fullwidth')?>" data-hover="Blog">Blog</a></li>
    								<li class="cl-effect-11"><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'about')?>" data-hover="About">About</a></li>
    								<li class="cl-effect-11"><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'contact')?>" data-hover="Contact">Contact</a></li>
  								</ul>
							</div><!-- /.navbar-collapse -->
						</nav>
						<div id="header-search-box">
							<a id="search-menu" href="#"><span id="search-icon">✎</span></a>
							<div id="search-form" class="search-form">
								<form role="search" method="get" id="searchform" action="#">
									<input type="search" placeholder="Search" required>
									<button type="submit">ღ</button>
								</form>				
							</div>
						</div>
					</div><!-- col-md-8 -->
				</div>
			</header>
		</div>
		<div class="copyrights">Collect from <a href="http://mysweet95.com/" >胡来建站</a></div>