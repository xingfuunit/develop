<div class="wrap">
    <div class="titleBar">
        <span><i class="wechat-return fa fa-angle-left"></i>返回</span>
        <h3>公司简介</h3>
        <i class="fa fa-home"></i>
    </div>
  <div class="company-desc">
    <ul>
        <li>
            <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-top.png">
        </li>
        <li>
            <p>“品珍鲜活”是国通与香港品珍合作创立的O2O电商平台，定位于高端进口食材与食品，主营全球精选的生猛活鲜、精选肉食、时令鲜果等。品珍立足线下体验与服务网络，引爆线上移动商机。在未来3-5年，品珍电商将逐步进入广佛、莞深、上海、北京等中国四大一线城市圈。通过在线下旗舰店与高端社区服务店的布局，线上以移动端为重点的云端VIP营销与购物体验，品珍将服务网络逐步覆盖四大一线城市圈百万家庭。</p>
        </li>
        <li>
            <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-middle.png">
        </li>
        <li>
            <p>全球直采供应链+全冷链物流仓配+全网络信息化管理。品珍拥有领先的技术体系和高效的运营团队，通过整合广东国通物流城3万吨冷链物流仓储、10万平米保税物流中心、进口鲜活水产品保税仓、国内最大的80万斤龙虾中转养殖基地、国内一流农产品检测中心、佛山市智慧菜篮子工程食材世界等强大的供应链与商品资源以及香港品珍国际资本与技术优势，品珍将建设覆盖国内一线城市的最先进的O2O服务网络，创造互联网“鲜活电商”又一高度。</p>
        </li>
        <li>
            <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-bottom.png">
        </li>
        <li>
            <p>“品珍全球·私享鲜活”是品珍电商的最佳注解，汇聚全球的精品食材，以严苛的品质要求和极致的服务来面对每一位顾客。品珍电商致力于成为“您的品质生活供应商”，并期待与每一位顾客共同创造，与每一位员工共同成长，在不远的将来成为全球领先的O2O电商品牌。</p>
        </li>
        <li>
            <embed pluginspage="http://get.adobe.com/cn/flashplayer/" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" id="tenvideo_flash_player_1437622096131" name="tenvideo_flash_player_1437622096131" quality="high" src="http://imgcache.qq.com/tencentvideo_v1/player/TPout.swf?max_age=86400&amp;v=20140714" flashvars="vid=s0141ozwbxp&amp;tpid=0&amp;showend=1&amp;showcfg=1&amp;searchbar=1&amp;pic=http://shp.qpic.cn/qqvideo_ori/0/s0141ozwbxp_496_280/0&amp;shownext=1&amp;list=2&amp;autoplay=0" wmode="direct">
        </li>
    </ul>
  </div>
    <div class="footerBar">
        <ul>
            <li><i class="fa fa-home"></i>首页</li>
            <li><i class="fa fa-phone"></i>联系小珍</li>
            <li><i class="fa fa-shopping-cart"></i>购物车</li>
            <li><i class="fa fa-user"></i>我的品珍</li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/js/sea.js"></script>
<script>
     $(function(){
        seajs.use('<?php echo Yii::$app->request->hostInfo;?>/pzfresh/js/pzfresh-wechat',function(ex){
            ex.returnback();//返回上一页
            ex.footer();//底部导航
        });
     });
</script>
