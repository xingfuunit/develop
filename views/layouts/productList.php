<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" />
        <title>品珍精选</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->hostInfo.Yii::$app->urlManager->baseUrl;?>/pzfresh/css/pzfresh-reset.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->hostInfo.Yii::$app->urlManager->baseUrl;?>/pzfresh/css/pzfresh-wechat.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->hostInfo.Yii::$app->urlManager->baseUrl;?>/pzfresh/css/font-awesome.min.css">
        <script type="text/javascript" src="<?php echo Yii::$app->request->hostInfo.Yii::$app->urlManager->baseUrl;?>/pzfresh/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::$app->request->hostInfo.Yii::$app->urlManager->baseUrl;?>/pzfresh/js/sea.js"></script>
        <script>
            $(function() {
                seajs.use('<?php echo Yii::$app->request->hostInfo.Yii::$app->urlManager->baseUrl;?>/pzfresh/js/pzfresh-wechat', function(ex) {
                    ex.returnback();//返回上一页
                    ex.tab();//商品排序方法切换
                    ex.swipedown();//向下滑动，产生瀑布流效果 && 点击弹窗
                    ex.cart(); //加入购物车，弹层信息
                    ex.footer();//底部导航
                });
            });
        </script>
    </head>
    <body>
        <?= $content ?>
    </body>
</html>