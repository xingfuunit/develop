<footer class="footer">
    <ul>
        <li><a href="http://www.pinzhen365.com/"><i class="fa fa-home"></i><span>首页</span></a></li>
        <li><a href="tel:400-930-9303"><i class="fa fa-phone"></i><span>联系小珍</span></a></li>
        <li><a href="http://www.pinzhen365.com/wap/cart.html">
                <i class="fa fa-shopping-cart add-to-cart">
                    <span class="cart-num">1</span>
                </i><span>购物车</span></a></li>
        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['product/details', 'product_id' => $product['product_id']]); ?>"><i class="fa fa-user"></i><span>我的品珍</span></a></li>
    </ul>
</footer>