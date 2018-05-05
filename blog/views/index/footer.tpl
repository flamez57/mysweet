
		<footer id="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright">&copy; 2014 ThemeWagon.com -More Templates <a href="http://mysweet95.com/" target="_blank" title="胡来建站">胡来建站</a> - Collect from <a href="http://mysweet95.com/" title="胡来建站" target="_blank">胡来建站</a></p>
					</div>
				</div>
			</div>
		</footer>

		<!-- Mobile Menu -->
		<div class="overlay overlay-hugeinc">
			<button type="button" class="overlay-close"><span class="ion-ios-close-empty"></span></button>
			<nav>
				<ul>
					<li><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'index')?>">Home</a></li>
					<li><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'fullwidth')?>">Blog</a></li>
					<li><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'about')?>">About</a></li>
					<li><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'contact')?>">Contact</a></li>
				</ul>
			</nav>
		</div>
        <?=\hl\HLView::js('script.js');?>
	</body>
</html>
