<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

//引入DI容器
use yii\di\Container;

class SiteController extends Controller
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
        //获取分类树
        $tree = $this->categoryService->getCateTree();
        //品珍鲜果
        $xg_products = $this->productService->getIndexProductListByCat(23);
        //品珍海鲜
        $hx_products = $this->productService->getIndexProductListByCat(23);
        //品珍鲜肉
        $xr_products = $this->productService->getIndexProductListByCat(28);
        //品珍精选
        $jx_products = $this->productService->getIndexProductListByCat(23);

        $list = $this->advertService->getAdvertList();
        //首页滚动banner
        $roll_banners = $list[3];
        //首页优惠券广告
        /*$coup_ads = $list[4];
        //促销图片广告
        $pic_ads = $list[5];
        //送免邮券广告
        $freeship_ads = $list[6];
        //滚动文字
        $roll_texts = $list[7];*/
        //print_r($list);
        return $this->render('index', ['cat_tree' => $tree, '']);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
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
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
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
/*$client->put('http://httpbin.org/put',['json' => ['foo' => 'bar']]);//json
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
]);*/


//并发请求
//$client = new Client(['base_uri' => 'http://httpbin.org/']);

// Initiate each request but do not block
/*$promises = [
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
echo $results['png']->getHeader('Content-Length');*/
    }

    public function actionTest1()
    {
         $list = $this->userService->getAllUsers();
         print_r($list);
    }

     //商品列表
    public function actionGallery() {
//       echo \Yii::$app->urlManager->createUrl(['site/gallery',['cat_id'=>1]]);exit;
//       \yii::$app->basePath.'\web\pzfresh\css\';
        $this->layout = 'productList';
        $request = \Yii::$app->request;
        $cat_id = $request->get('cat_id');
        $page = $request->get('page', 1);
        $type = $request->get('type', 1);
        $ProductList = $this->productService->getProductList($cat_id, $page, $type);
        $num = $this->productService->getGoodsNum($cat_id);
        return $this->render('gallery', ['ProductList' => $ProductList, 'num' => $num, 'cat_id' => $cat_id, 'type' => $type]);
    }

    //翻页获取数据
    public function actionProduct() {
        $request = \Yii::$app->request;
        $cat_id = $request->get('cat_id');
        $page = $request->get('page', 1);
        $type = $request->get('type', 1);
        $ProductList = $this->productservice->getProductList($cat_id, $page, $type);
        echo json_encode($ProductList);
    }
}
