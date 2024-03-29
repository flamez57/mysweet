<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>地址添加</title>
	<?=\hl\HLView::css('loaders.min.css');?>
    <?=\hl\HLView::css('loading.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('style.css');?>
    <?=\hl\HLView::js('jquery.min.js');?>
    <script type="text/javascript">
    	$(window).load(function(){
    		$(".loading").addClass("loader-chanage")
    		$(".loading").fadeOut(300)
    	})
    </script>
</head>
<!--loading页开始-->
<div class="loading">
	<div class="loader">
        <div class="loader-inner pacman">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
	</div>
</div>
<!--loading页结束-->
<body>
	<header class="top-header fixed-header">
		<a class="icona" href="javascript:history.go(-1)">
			<?=\hl\HLView::img('images/left.png');?>
		</a>
		<h3>地址添加</h3>
			<a class="text-top" >
			</a>
	</header>

	<div class="contaniner fixed-conta">
		<form action="" method="post" class="change-address" id="save">
			<ul>
				<li>
					<label class="addd">收货人：</label>
					<input type="text" value="" required="required"/>
				</li>
				<li>
					<label class="addd">手机号：</label>
					<input type="tel" value="" required="required"/>
				</li>
				<li>
					<label class="addd">所在地区：</label>
					<select>
						<option>安徽省</option>
						<option>安徽省</option>
						<option>安徽省</option>
					</select>
					<select>
						<option>合肥市</option>
						<option>安庆市</option>
						<option>上海市</option>
					</select>
					<select>
						<option>高新区</option>
						<option>蜀山区</option>
						<option>庐阳区</option>
					</select>
				</li>
				<li>
					<label class="addd">详细地址：</label>
					<textarea required="required"></textarea>
				</li>
			</ul>

			<ul>
				<li class="checkboxa">
					<input type="checkbox" id="check"/>
					<label class="check" for="check" onselectstart="return false"  >设置为默认地址</label>
				</li>
			</ul>
			<ul>
				<li>
					<h3>删除此地址</h3>
				</li>
			</ul>
			<input type="submit" value="保存" />
		</form>
	</div>

	<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(".checkboxa label").on('touchstart',function(){
			if($(this).hasClass('checkd')){
				$(".checkboxa label").removeClass("checkd");
			}else{
				$(".checkboxa label").addClass("checkd");
			}
		})
	</script>


</body>
</html>
