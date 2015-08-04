<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'pzfresh/css/wxshop.css',
        'pzfresh/css/font-awesome.min.css',
        'pzfresh/css/pzfresh-reset.css',
        'pzfresh/css/pzfresh-wechat.css',
        'pzfresh/css/wxshop.css',
    ];
    public $js = [
        'pzfresh/js/sea.js',
        'pzfresh/js/jquery.min.js',
    ];
    public $depends = [
            //'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];

}
