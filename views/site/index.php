		<header class="index-header">
			<h1>
			<a class="company-link" href="">
			<i class="fa fa-exclamation-circle"></i>
			</a>
			<a href="#">搜索商品 </a>
			</h1>
		</header>

		<div id="index-page">
			<?php if (! empty($roll_banners)) {
				$num = 0;
			?>
			<div id="banner">
				<div class="banner-wrapper">
					<ul class="banner-scroll">
						<?php foreach ($roll_banners as $val) {
							$num++;
						?>
						<li><a href="<?=$val['link_url']?>"><img src="<?=$val['img_url']?>" draggable="false"></a></li>
						<?php } ?>
					</ul>
					<div class="banner-switch">
						<?php for ($i = 0; $i < $num; $i++) { ?>
						<span <?php if ($i == 0) { ?>class="on" <?php } ?>></span>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
			<!---------- scroll end and content start ---------->
			<div class="content">
				<div class="search-wrapper">
					<form action="<?=Yii::$app->urlManager->createUrl('site/gallery')?>" method="get">
						<div class="search-text">
							<i class="fa fa-search"></i>
							<input class="am-form-field" placeholder="搜索商品：请输入商品关键字" name="keywords" type="text">
							<input type="hidden" name="search" value="search">
						</div>
					</form>
				</div>
				<div class="nav">
					<ul>
						<li><a id="sidebar-open" href="javascript:void(0)"><img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/icon/k1.jpg" draggable="false"></a></li>
						<li><a href="http://www.pinzhen365.com/wap/active-alist.html"><img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/icon/k2.jpg" draggable="false"></a></li>
						<li><a href="<?=Yii::$app->urlManager->createUrl('site/hotproducts')?>"><img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/icon/k3.jpg" draggable="false"></a></li>
						<li><a href="http://www.pinzhen365.com/wap/active-hyday.html"><img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/icon/k4.jpg" draggable="false"></a></li>
					</ul>
				</div>
				<div class="promotion">
				<?php
				if (! empty($roll_texts)) {
					foreach ($roll_texts as $val) { ?>
					<p class="volume">
					<i class="fa fa-volume-up"></i><?=$val['title']?>
					</p>
				<?php
			    }
			    	}
			    ?>
				<?php
				if (! empty($coup_ads)) {
					foreach ($coup_ads as $val) {
						if ($val['ad_type'] != 'coupon') {
					?>
					<p><a href="<?=$val['link_url']?>"><img src="<?=$val['img_url']?>"></a></p>
					<?php
						} else {
					?>
					<p><a class="get-gift" href="javascript:void(0)" data-coupon="<?=$val['link_url']?>"><img src="<?=$val['img_url']?>"></a></p>
				<?php
				    	}
                    }
                }
				?>
				<?php
				if (! empty($freeship_ads)) {
					foreach ($freeship_ads as $val) {
						if ($val['ad_type'] != 'coupon') {
					?>
					<p><a href="<?=$val['link_url']?>"><img src="<?=$val['img_url']?>"></a></p>
					<?php
						} else {
					?>
					<p><a class="get-gift" href="javascript:void(0)" onclick="getCoupon444('<?=$val['link_url']?>')"><img src="<?=$val['img_url']?>"></a></p>
				<?php
				    	}
                    }
                }
				?>
				<?php
				if (! empty($pic_ads)) {
					foreach ($pic_ads as $val) { ?>
					<p><a href="<?=$val['link_url']?>"><img src="<?=$val['img_url']?>"></a></p>
				<?php
				    }
			    }
			    ?>
				</div>

				<div class="pro-scan">
					<?php foreach ($index_products as $product) { ?>
					<div class="pro-item">
						<h2 class="item-name"><?=$product['top_cat']['cat_name']?><a href="<?=Yii::$app->urlManager->createUrl(['site/gallery/', 'cat_id' => $product['top_cat']['cat_id']])?>">更多</a></h2>
						<ul>
							<?php foreach ($product['products'] as $val) { ?>
							<li>
								<a href="<?=$val['product_id']?>">
								<img src="<?=$val['img']?>">
								<div class="info">
									<h3><?=$val['product_name']?></h3>
									<span class="selled">已售：<?=$val['buy_count']?>份</span>
									<br>
									<b>&yen;<?=$val['price']?></b>
								</div>
								</a>
								<i class="fa fa-shopping-cart add-to-cart"></i>
							</li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
				</div>
				<div class="foot-banner">
					<img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/pic/qming.jpg">
				</div>
			</div>
			<div id="sidebar">
				<ul class="menu">
					<?php foreach ($cat_tree as $cat) { ?>
					<li class="open">
						<a class="menu-nav" href="javascript:void(0);">
						<?=$cat['cat_name']?>
						</a>
						<div class="sub-menu">
							<?php foreach ($cat['son'] as $child) { ?>
							<a href="<?=Yii::$app->urlManager->createUrl(['site/gallery/', 'cat_id' => $child['cat_id']])?>" class=""><?=$child['cat_name']?></a>
							<?php } ?>
							<a href="<?=Yii::$app->urlManager->createUrl(['site/gallery/', 'cat_id' => $cat['cat_id']])?>" class="" title="<?=$cat['cat_name']?>">全部商品 »</a>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<!---------- content end ---------->
		</div>
		<div class="comm-alert">
			<!--弹出框-->
			<div class="mask"></div>
			<!-- 提交等待 弹出框 -->
			<div id="alert-loading" class="modal-alert">
				<div class="alert-msg">正在载入...</div>
				<div class="alert-loading-footer">
					<i class="loading fa fa-spinner fa-spin"></i>
				</div>
			</div>
			<!-- 提交结果 弹出框 -->
			<div id="alert-msg" class="modal-alert">
				<div class="alert-msg">
					您还没有登录，请登录！
				</div>
				<div class="alert-but">
					<span>确定</span>
				</div>
			</div>
			<!-- 加入购物车弹出框  -->
			<div id="alert-cart" class="modal-alert ">
				<div class="alert-msg">
					您还没有登录，请登录！
				</div>
				<div class="alert-but alert-cart-footer">
					<span><a href="/wap/cart.html">进入购物车</a></span>
					<span class="keep">继续购物</span>
				</div>
			</div>
		</div>
		<footer class="footer">
			<ul>
				<li><a href="http://www.pinzhen365.com/"><i class="fa fa-home"></i><span>首页</span></a></li>
				<li><a href="tel:400-930-9303"><i class="fa fa-phone"></i><span>联系小珍</span></a></li>
				<li><a href="http://www.pinzhen365.com/wap/cart.html">
					<i class="fa fa-shopping-cart add-to-cart">
					<span class="cart-num">1</span>
				</i><span>购物车</span></a></li>
				<li><a href="http://www.pinzhen365.com/wap/member.html"><i class="fa fa-user"></i><span>我的品珍</span></a></li>
			</ul>
		</footer>
		<script type="text/javascript" src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/js/sea.js"></script>
		<script type="text/javascript">
			seajs.config({
				base: "<?php echo Yii::$app->request->hostInfo;?>/pzfresh/js",
				alias: {
					"jquery": "jquery.sea",
					"jqueryTouchSwipe": "jquery.TouchSwipe.sea"
				}
			});
			seajs.use(['index','comm','jquery','jqueryTouchSwipe'],function(index,comm){
				index.init();
				index.indexScroll(4000,1000);

				comm.shopCart();
			});
		</script>
