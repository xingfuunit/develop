<div class="wrap">
	<ul class="enterpage">
    <li>
      <a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8a9533e11b69d7a2&redirect_uri=http%3A%2F%2Fwww.pzfresh.com%2Findex.php%2Fwap&response_type=code&scope=snsapi_base&state=573174#wechat_redirect">
         <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-01.png"/>
      </a>
    </li>
    <li>
      <a href="http://wap.koudaitong.com/v2/home/1gqo5u27f">
         <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-02.png"/>
      </a>
    </li>
    <li>
      <a href="http://wap.koudaitong.com/v2/home/ccwvnqcs">
         <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-03.png"/>
      </a>
    </li>
    <li>
      <a href="http://wap.koudaitong.com/v2/home/yj1tewvi">
         <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-04.png"/>
      </a>
    </li>
    <li>
      <a href="tel:400-930-9303">
        <img src="<?php echo Yii::$app->request->hostInfo;?>/pzfresh/img/banner-06.png">
      </a>
    </li>
  </ul>
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
