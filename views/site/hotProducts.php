<header>
    <h1>
        <a class="left" href="<?=Yii::$app->urlManager->createUrl('site/index')?>">
            <i class="fa fa-reply"></i>
        </a>
        <a href="#">搜索商品</a>
        <a class="right" href="#">
            <i class="fa fa-search"></i>
        </a>
    </h1>
</header>
<div id="hot-sell">
    <div class="hot-sample">
        HOT：
        <a href="">三文鱼</a>
        <a href="">奇异果</a>
        <a href="">芒果</a>
        <a href="">青口</a>
        <a href="">澳洲牛肉</a>
    </div>
    <?php foreach ($hotProducts as $product) { ?>
        <div class="hot-list">
            <div class="hot-item">
                <a href="#">
                    <div class="sell-pic">
                        <div class="sell-num">
                            <i>1</i>
                            <span>销量:<?php echo $product['buy_count'] ?>份</span>
                        </div>
                        <img src="<?php echo yii::$app->params['img_url'].$product['original_url']; ?>">
                    </div>
                    <div class="sell-desc">
                        <p class="title"><?php echo $product['name']; ?></p>
                        <p class="sell-price">
                            <span>&yen;<?php echo $product['price']; ?></span>
                            <del>&yen;<?php echo $product['mktprice']; ?></del>
                        </p>
                        <i class="fa fa-shopping-cart add-to-cart"></i>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>

</div>
<?php require(__DIR__ .'/footer.php');?>
