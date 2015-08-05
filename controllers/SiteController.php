<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Url;
//引入DI容器
use yii\di\Container;
use yii\web\Cookie;

class SiteController extends Controller
{

    private $advertService;
    private $categoryService;
    private $productService;
    public $enableCsrfValidation = false;

    public function __construct($id, $module, $config = [])
    {
        //DI容器获取实例化的对象
        //通过DI容器来创建、获取实例的。
        $this->advertService = \Yii::createObject('advertservice');
        $this->categoryService = \Yii::createObject('categoryservice');
        $this->productService = \Yii::createObject('productservice');
        parent::__construct($id, $module, $config);
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
//            [
//                'class' => 'yii\filters\PageCache',
//                'duration' => 1000,
//                'only' => ['hotproducts', 'cache'],
//                'dependency' => [
//                    'class' => 'yii\caching\FileDependency',
//                    'fileName' => '111.php'
//                ]
//            ],
//            [
//                'class' => 'yii\filters\HttpCache',
//                'only' => ['hotproducts', 'cache','gallery'],
//                'lastModified' => function ()
//                {
//                    return 123;
//                },
//                'etagSeed'=>  function(){
//                    return 'adf';
//                }
//                ],
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

    public function actionEnter()
    {
        $this->getView()->title = '品珍鲜活';
        Yii::$app->view->registerCssFile(Yii::$app->request->hostInfo . '/pzfresh/css/pzfresh-reset.css');
        Yii::$app->view->registerCssFile(Yii::$app->request->hostInfo . '/pzfresh/css/pzfresh-wechat.css');
        return $this->render('enterpage');
    }

    public function actionIndex()
    {
        //获取分类树
        $tree = $this->categoryService->getCateTree();
        //获取顶级分类
        $index_products = [];
        foreach ($tree as $val)
        {
            $products = $this->productService->getIndexProductListByCat($val['cat_id']);
            $index_products[] = ['top_cat' => ['cat_id' => $val['cat_id'], 'cat_name' => $val['cat_name']], 'products' => $products];
        }
        $list = $this->advertService->getAdvertList();

        //首页滚动banner
        $roll_banners = [];
        if (array_key_exists('index_roll_banner', $list))
        {
            $roll_banners = $list['index_roll_banner'];
        }

        $coup_ads = [];
        if (array_key_exists('index_coup_banner', $list))
        {
            $coup_ads = $list['index_coup_banner'];
        }
        //促销图片广告
        $pic_ads = [];
        if (array_key_exists('index_pic_banner', $list))
        {
            $pic_ads = $list['index_pic_banner'];
        }
        //送免邮券广告
        $freeship_ads = [];
        if (array_key_exists('index_coup_mianyou', $list))
        {
            $freeship_ads = $list['index_coup_mianyou'];
        }
        //滚动文字
        $roll_texts = [];
        if (array_key_exists('index_coup_mianyou', $list))
        {
            $roll_texts = $list['index_roll_text'];
        }

        $this->getView()->title = '品珍鲜活';
        Yii::$app->view->registerCssFile(Yii::$app->request->hostInfo . '/pzfresh/css/wxshop.css');
        // Yii::app()->params['old_site'];
        //$this->registerCssFile()
        return $this->render('index', ['cat_tree' => $tree, 'index_products' => $index_products, 'roll_banners' => $roll_banners, 'coup_ads' => $coup_ads, 'pic_ads' => $pic_ads, 'freeship_ads' => $freeship_ads, 'roll_texts' => $roll_texts]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        }
        else
        {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
        {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        else
        {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
        //require 'vendor/autoload.php';
        $client = new \GuzzleHttp\Client();
        $res = $client->get('http://www.pzfresh.com');

//$response = $client->get('http://httpbin.org/get');
//$response = $client->delete('http://httpbin.org/delete');
//$response = $client->head('http://httpbin.org/get');
//$response = $client->options('http://httpbin.org/get');
//$response = $client->patch('http://httpbin.org/patch');
//$response = $client->post('http://httpbin.org/post');
//$response = $client->put('http://httpbin.org/put');
//echo $res->getStatusCode();
// "200"
//echo $res->getHeader('content-type');
// 'application/json; charset=utf8'
        echo $res->getBody();

//参数
        /* $client->put('http://httpbin.org/put',['json' => ['foo' => 'bar']]);//json
          $client->get('http://httpbin.org', [
          'query' => ['foo' => 'bar']
          ]);//
          $response = $client->post('http://httpbin.org/post', [
          'form_params' => [
          'field_name' => 'abc',
          'other_field' => '123',
          'nested_field' => [
          'nested' => 'hello'
          ]
          ]
          ]); */


//并发请求
//$client = new Client(['base_uri' => 'http://httpbin.org/']);
// Initiate each request but do not block
        /* $promises = [
          'image' => $client->get('/image'),
          'png'   => $client->get('/image/png'),
          'jpeg'  => $client->get('/image/jpeg'),
          'webp'  => $client->get('/image/webp')
          ];

          // Wait on all of the requests to complete.
          $results = Promise\unwrap($promises);

          // You can access each result using the key provided to the unwrap
          // function.
          echo $results['image']->getHeader('Content-Length');
          echo $results['png']->getHeader('Content-Length'); */
    }

    public function actionTest1()
    {
        $list = $this->userService->getAllUsers();
        print_r($list);
    }

    //商品列表
    public function actionGallery()
    {
        $this->getView()->title = '品珍精选';
//        $this->layout = 'productList';
        $request = \Yii::$app->request;
        $cat_id = $request->get('cat_id');
        $page = $request->get('page', 1);
        $type = $request->get('type', 1);
        $search = $request->get('search');
        $ProductList = $this->productService->getProductList($cat_id, $page, $type);
        $keywords = $request->get('keywords', '');
        $num = $this->productService->getProductNum($cat_id);
        if ($search)
        {
            $ProductList = $this->productService->getProductList($keywords, $page, $type, $search);
            $num = $this->productService->getProductNum($keywords,'search');
        }
        return $this->render('gallery', ['ProductList' => $ProductList, 'num' => $num, 'cat_id' => $cat_id, 'type' => $type, 'search' => $search, 'keywords' => $keywords]);
    }

    //翻页获取数据
    public function actionProduct()
    {
        $request = \Yii::$app->request;
        $cat_id = $request->get('cat_id');
        $page = $request->get('page', 1);
        $type = $request->get('type', 1);
        $search = $request->get('search');
        $keywords = $request->get('keywords', '');
        $ProductList = $this->productService->getProductList($cat_id, $page, $type);
        if ($search)
        {
            $ProductList = $this->productService->getProductList($keywords, $page, $type, $search);
        }
        echo json_encode($ProductList);
    }

    public function actionHotproducts()
    {
//        $this->layout = 'hotProducts';
        $HotProducts = $this->productService->getHotProducts();
        return $this->render('hotProducts', ['hotProducts' => $HotProducts]);
    }

    public function actionSearchproducts()
    {
        $cookies = \Yii::$app->request->cookies;
        $keywords = $cookies->getValue('keywords');
        $keywords = explode(',', $keywords);
        $keywords = array_unique($keywords);
        return $this->render('searchProducts', ['keywords' => $keywords]);
    }

    public function actionSearchresult()
    {
        $request = \Yii::$app->request;
        $cookie = \Yii::$app->response->cookies;
        $keyword = $request->post('keywords');
        $keywords = $request->cookies->getValue('keywords') . ',' . $keyword;
        $cookie_data = ['name' => 'keywords', 'value' => $keywords];
        $cookie->add(new Cookie($cookie_data));
        $this->redirect(['site/gallery', 'keywords' => $keyword, 'search' => 'search']);
    }

    public function actionComment()
    {
        /* $request = \Yii::$app->request;
          $product_id = (int) $request->get('product_id');
          $page = (int) $request->get('page');
          //echo json_encode();
          $this->getView()->title = '评论列表-品珍鲜活';
          return $this->render('comments', $comment_list); */
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://devjason.pinzhen365.com/wap/wapi.html?clt=goods&act=comments_list', ['json' => ['goods_id' => 18, 'start_page' => 1, 'page_num' => 5]]);
        echo $response->getBody();
    }

    public function actionGet()
    {
        
    }

    public function actionCompany()
    {
        Yii::$app->view->registerCssFile(Yii::$app->request->hostInfo . '/pzfresh/css/pzfresh-reset.css');
        Yii::$app->view->registerCssFile(Yii::$app->request->hostInfo . '/pzfresh/css/pzfresh-wechat.css');
        $this->getView()->title = '公司简介-品珍鲜活';
        return $this->render('company');
    }

    public function actionCart()
    {
        $client = new \GuzzleHttp\Client();
        $request = \Yii::$app->request;
        $goods_id = $request->post('goods_id');
        $product_id = $request->post('product_id');
        $product_num = $request->post('product_num');
        $cookies = Yii::$app->request->cookies;
        $sid = $cookies->getValue('sid', uniqid());
        $response = $client->post(Yii::$app->params['cart_add'], [
            'json' => [
                'sid' => $sid,
                'goods_id' => $goods_id,
                'product_id' => $product_id,
                'product_num' => $product_num,
            ]
        ]);
        echo $response->getBody();
    }

    public function actionCache()
    {
//        $cache = \yii::$app->cache;
//        $cache->add('key','value');
//        $data=$cache->get('key');
//        var_dump($data);
//        $cache->delete('key');
//        $cache->flush();
//        echo '<br>---------------<br>';
//        var_dump($data);
//        
//        $dependency = new \yii\caching\FileDependency(['fileName' => '111.php']);
//        $cache->set('key', 'filen', 3000, $dependency);
//        $dependency = new \yii\caching\ExpressionDependency(
//                ['expression' => '\yii::$app->request->get("name")']);
//        $cache->set('key', 'expression', 3000, $dependency);
//        $dependency = new \yii\caching\DbDependency(
//                ['sql' => 'select count(*) from {{%goods}}']);
////        $cache->set('key', 'db', 3000, $dependency);
//        $data = $cache->get('key');
//        var_dump($data);
        return $this->render('cache');
    }

}
