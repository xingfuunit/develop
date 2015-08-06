<div class="wrap">
    <div class="titleBar">
        <span><i class="wechat-return fa fa-angle-left"></i>返回</span>
        <h3>品珍鲜活</h3>
        <i class="search fa fa-search"></i>
    </div>
    <div class="shop-list">
        <ul class="shop-nav">
            <li class="active">销量<i class="fa fa-caret-down"></i></li>
            <li>价格<i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></li>
            <li class="pj">评价<i class="fa fa-caret-down"></i></li>
            <li class="sj">上架<i class="fa fa-caret-down"></i></li>
        </ul>
        <ul class="shop-menu">
            <li class='product'>
                <?php foreach ($ProductList as $product)
                { ?>
                    <dl>
                        <dt>
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['product/details', 'product_id' => $product['product_id']]); ?>"><img src="<?php echo yii::$app->params['img_url'] . $product['original_url']; ?>"/></a>
                        </dt>
                        <dd>
                            <ul>
                                <li><?php echo $product['name']; ?></li>
                                <li><?php echo isset($product['brief']) ? $product['brief'] : ''; ?></li>
                                <li class="middle">省<?php echo $product['mktprice'] - $product['price'] ?>元</li>
                                <li class="current-price"><?php echo $product['price']; ?></li>
                                <li class="old-price">
                                    <del><?php echo $product['mktprice']; ?></del>
                                </li>
                                <li class="cart" product_id="<?php echo $product['product_id']; ?>" goods_id="<?php echo $product['goods_id']; ?>">
                                    <i class="fa fa-shopping-cart"></i>
                                </li>
                            </ul>	
                        </dd>
                    </dl>
<?php } ?>
            </li>
        </ul>
        <span class="total-page">共<i><?php echo $num; ?></i>个商品</span>
        <span class="page-num"><i>1</i>/<i><?php echo ceil($num / 5); ?></i></span>
        <span id='num' value="<?php echo ceil($num / 5); ?>"></span>
        <span id='cat_id' value="<?php echo $cat_id; ?>"></span>
        <span id='type' value="<?php echo $type; ?>"></span>
        <span id='click' value=""></span>
        <span id='search' value="<?php echo $search ?>"></span>
        <span id='keywords' value="<?php echo $keywords ?>"></span>
        <span id='url' value="<?php echo Yii::$app->urlManager->createUrl(['site/product']); ?>"></span>
        <span id='cart_url' value="<?php echo Yii::$app->urlManager->createUrl(['site/cart']); ?>"></span>
        <span id='img_url' value="<?php echo yii::$app->params['img_url']; ?>"></span>
        <span id='search_url' value="<?php echo Yii::$app->urlManager->createUrl(['site/searchproducts']); ?>"></span>
        <?php require(__DIR__ .'/footer.php');?>
    </div>
    <div class="cover">
        <ul>
            <li>加入购物车成功</li>
            <li>查看购物车</li>
            <li>继续购物(<i>3</i>)</li>
        </ul>
    </div>
    <div class="cover_false">
        <ul>
            <li>加入购物车成功</li>
            <li>查看购物车</li>
            <li>继续购物(<i>3</i>)</li>
        </ul>
    </div>
</div>