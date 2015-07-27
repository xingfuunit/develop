<?php

namespace app\service;

use app\models\Product;
use app\models\Images;
use yii\base\Object;
/**
 *业务逻辑实现
 *实现商品业务逻辑接口
 *
 */
class IProductServiceimpl extends Object implements IProductService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndexProductListByCat($cat_id)
    {
        //$list = Product::getInstance()->geIndexGoodsList();
        $category_service = \Yii::createObject('categoryservice');
        $cat_list = $category_service->getChildrenCat($cat_id);
        $product_list = Product::getInstance()->getIndexProductList($cat_list);

        $product_id_list = [];
        foreach ($product_list as $product) {
            $product_id_list[] = $product['product_id'];
        }

        //获取商品图片
        $image_list = Images::getInstance()->getDefaultImages($product_id_list);
        foreach ($product_list as $k => $product) {
            foreach ($image_list as $image) {
                if ($product['image_id'] == $image['image_id']) {
                    $product_id_list[$k]['img'] = $image['thumb_url'];
                }
            }
        }

        //获取商品库存
        $client = new \GuzzleHttp\Client();
        //$res = $client->get('http://www.pzfresh.com');
        return $product_list;
    }

     /*
     * $cat_id 栏目id
     * $page 页数
     * $type 排序类型
     */

    public function getProductList($cat_id, $page, $type) {
        switch ($type) {
            case 1://销量倒序
                $order = "order by g.buy_count desc";
                break;
            case 2://价格倒序
                $order = "order by p.price desc";
                break;
            case 3://价格升序
                $order = "order by p.price asc";
                break;
            case 4://评论倒序
                $order = "order by g.comments_count desc";
                break;
            case 5://上架时间倒序
                $order = "order by g.uptime desc";
                break;
            default :
                $order = "order by g.buy_count desc";
        }
        $offset = 5;
        $pagesize = $page > 1 ? $offset * ($page - 1) : 0;
        $sql = "select * from {{%goods}} g left join {{%product}} p on g.goods_id = p.goods_id "
                . "join {{%images}} i on i.image_id = g.image_default_id  where g.cat_id = :cat_id"
                . " and p.is_default = 1  $order limit :pagesize,:offset";
        ;
        $db = \yii::$app->db;
        $command = $db->createCommand($sql);
        $command->bindParam(":cat_id", $cat_id, \yii\db\mssql\PDO::PARAM_INT);
        $command->bindParam(":pagesize", $pagesize, \yii\db\mssql\PDO::PARAM_INT);
        $command->bindParam(":offset", $offset, \yii\db\mssql\PDO::PARAM_INT);
        $product = $command->queryAll();
        return $product;
//        $goods = Goods::find()->where('cat_id=:cat_id', [':cat_id' => $cat_id])->asArray()->all();
//        $goods_id = array();
//        foreach ($goods as $good) {
//            $goods_id[] = $good['goods_id'];
//        }
//        $product=  Product::find()->where(['in', 'goods_id', $goods_id])->asArray()->limit(10)->all();
//        var_dump($product);exit;
    }

    public function getGoodsNum($cat_id) {
        $num = Goods::find()->where('cat_id=:cat_id', [':cat_id' => $cat_id])->asArray()->all();
        return count($num);
    }
}

