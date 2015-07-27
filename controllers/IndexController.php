<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

//引入DI容器
use yii\di\Container;

class IndexController extends Controller
{

    private $advertService;
    private $categoryService;
    private $productService;

    public function __construct($id, $module,$config = [])
    {
        //DI容器获取实例化的对象
        //通过DI容器来创建、获取实例的。
        $this->advertService = \Yii::createObject('advertservice');
        $this->categoryService = \Yii::createObject('categoryservice');
        $this->productService = \Yii::createObject('productservice');
        parent::__construct($id, $module,$config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $cookies = Yii::$app->request->cookies;
        $cover = $cookies->getValue('cover', '1');
        if (! $cover) {
            $this->redirect('xxxx');
        }
        //获取分类树
        $tree = $this->categoryService->getCateTree();
        //获取顶级分类
        $index_products = [];
        foreach ($tree as $val) {
            $products = $this->productService->getIndexProductListByCat($val['cat_id']);
            $index_products[] = ['top_cat' => ['cat_id' => $val['cat_id'], 'cat_name' => $val['cat_name']], 'products' => $products];
        }

        $list = $this->advertService->getAdvertList();
        //首页滚动banner
        $roll_banners = [];
        if (array_key_exists('index_roll_banner', $list)) {
            $roll_banners = $list['index_roll_banner'];
        }

        //首页优惠券广告
        $coup_ads = [];
        if (array_key_exists('index_coup_banner', $list)) {
            $coup_ads = $list['index_coup_banner'];
        }
        //促销图片广告
        $pic_ads = [];
        if (array_key_exists('index_pic_banner', $list)) {
            $pic_ads = $list['index_pic_banner'];
        }
        //送免邮券广告
        $freeship_ads = [];
        if (array_key_exists('index_coup_mianyou', $list)) {
            $freeship_ads = $list['index_coup_mianyou'];
        }
        //滚动文字
        $roll_texts = [];
        if (array_key_exists('index_coup_mianyou', $list)) {
            $roll_texts = $list['index_roll_text'];
        }

        $this->getView()->title = '品珍鲜活';
        // Yii::app()->params['old_site'];
        //$this->registerCss()
        return $this->render('index', ['cat_tree' => $tree, 'index_products' => $index_products, 'roll_texts' => $roll_texts]);
    }
}
