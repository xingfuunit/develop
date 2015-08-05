<footer class="footer">
    <ul>
        <li><a href="/"><i class="fa fa-home"></i><span>首页</span></a></li>
        <li><a href="tel:400-930-9303"><i class="fa fa-phone"></i><span>联系小珍</span></a></li>
        <li><a href="<?=Yii::$app->urlManager->createUrl('site/gotocart')?>">
                <i class="fa fa-shopping-cart add-to-cart">
                    <span class="cart-num">1</span>
                </i><span>购物车</span></a></li>
        <li><a href="<?=Yii::$app->urlManager->createUrl('site/gotomembercenter')?>"><i class="fa fa-user"></i><span>我的品珍</span></a></li>
    </ul>
</footer>
