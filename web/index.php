<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

// 注册一个接口
Yii::$container->set('app\\service\\IUserService', 'app\\service\\IUserServiceimpl');
// 注册一个别名
Yii::$container->set('userservice','app\\service\\IUserService');

// 注册一个接口
Yii::$container->set('app\\service\\IAdvertService', 'app\\service\\IAdvertServiceimpl');
// 注册一个别名
Yii::$container->set('advertservice','app\\service\\IAdvertService');

// 注册一个接口
Yii::$container->set('app\\service\\ICategoryService', 'app\\service\\ICategoryServiceimpl');
// 注册一个别名
Yii::$container->set('categoryservice','app\\service\\ICategoryService');

// 注册一个接口
Yii::$container->set('app\\service\\IProductService', 'app\\service\\IProductServiceimpl');
// 注册一个别名
Yii::$container->set('productservice','app\\service\\IProductService');

(new yii\web\Application($config))->run();
