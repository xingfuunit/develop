<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="initial-scale=1.0,width=device-width,maximum-scale=1,minimum-scale=1.0,user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
    <script>
        $(function() {
            seajs.use('<?php echo Yii::$app->request->hostInfo . Yii::$app->urlManager->baseUrl; ?>/pzfresh/js/pzfresh-wechat', function(ex) {
                ex.returnback();//返回上一页
                ex.tab();//商品排序方法切换
                ex.swipedown();//向下滑动，产生瀑布流效果 && 点击弹窗
                ex.cart(); //加入购物车，弹层信息
                ex.footer();//底部导航
            });
        });
    </script>
</html>
<?php $this->endPage() ?>
