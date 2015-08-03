		<div id="p-comments">
			<?php if (! empty($comment_list)) { ?>
			<div class="comm-wrapper">
				<ul class="comm-list" commpage="100"><!-- 评论总页数 -->
					<?php foreach ($comment_list as $comment) { ?>
					<li>
						<div class="comm-avater">
							<img src="../img/sample/avater.png">
						</div>
						<div class="comm-text">
							<div class="par-comm">
								<p class="comm-title">
								<span class="comm-tel"><?=$comment['author']?></span>
								<span class="comm-data"><?=$comment['time']?></span>
								</p>
								<p class="comm-content"><?=$comment['comment']?>
								</p>
							</div>
							<?php foreach ($comment['items'] as $val) }
								if ($val['display'] == 'true' && $val['disabled'] == 'false') {
							?>
							<div class="sub-comm">
								<p class="comm-title">
								<span class="comm-tel">品珍客服回复</span>
								<span class="comm-data"><?=$val['time']?></span>
								</p>
								<p class="comm-content">
								<?=$val['comment']?>
								</p>
							</div>
							<?
								}
							}
							?>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<?php } else {?>
			<div class="no-more-comm">没有更多评论了!</div>
			<?php } ?>
			<div class="loading">
				<i class="fa fa-spinner fa-spin"></i>
			</div>
		</div>
		<script type="text/javascript" src="../js/sea.js"></script>
		<script type="text/javascript">
			seajs.config({
				base: "../js",
				alias: {
					"jquery": "jquery.sea",
				}
			});
			seajs.use(['productInfo','jquery'],function(productInfo){
				productInfo.commentsInit();
			});
		</script>
