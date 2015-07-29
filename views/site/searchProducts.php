<header>
    <h1>
        <a class="left" href="">
            <i class="fa fa-reply"></i>
        </a>
        <a href="#">搜索商品</a>
    </h1>
</header>
<div id="product-search">
    <div class="search-wrapper">
        <form action="<?php echo \Yii::$app->urlManager->createUrl(['site/searchresult']); ?>" class="search_form" method="post">
            <div class="search-text">
                <i class="fa fa-search"></i>
                <input class="am-form-field" type="text" placeholder="搜索商品：请输入商品关键字" name="keywords" value="">
            </div>
        </form>
    </div>
    <div class="search-msg">
        <div class="search-norecord">
            亲，你还没进行任何搜索(⊙o⊙)哦。
        </div>
        <div class="search-recent">
            <i class="fa fa-paper-plane"></i>
            最近搜索
        </div>
        <div  class="search-list">
            <?php foreach ($keywords as $value) { ?>
                <?php if (!empty($value)) { ?>
                    <a href="#"><?php echo $value; ?></a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<footer class="footer">
    <ul>
        <li><a href="http://www.pinzhen365.com/"><i class="fa fa-home"></i><span>首页</span></a></li>
        <li><a href="tel:400-930-9303"><i class="fa fa-phone"></i><span>联系小珍</span></a></li>
        <li><a href="http://www.pinzhen365.com/wap/cart.html">
                <i class="fa fa-shopping-cart">
                    <span class="cart-num">1</span>
                </i><span>购物车</span></a></li>
        <li><a href="http://www.pinzhen365.com/wap/member.html"><i class="fa fa-user"></i><span>我的品珍</span></a></li>
    </ul>
</footer>
<script type="text/javascript" src="<?php echo Yii::$app->request->hostInfo . Yii::$app->urlManager->baseUrl; ?>/pzfresh/js/sea.js"></script>
<script type="text/javascript">
</script>