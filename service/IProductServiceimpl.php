<?php

namespace app\service;

use app\models\Product;
use app\models\Images;
use yii;
use yii\base\Object;
use app\models\Goods;

/**
 * 业务逻辑实现
 * 实现商品业务逻辑接口
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
        $category_service = \Yii::createObject('categoryservice');
        $cat_list = $category_service->getChildrenCat($cat_id);
        $product_list = Product::getInstance()->getIndexProductList($cat_list);

        $product_id_list = [];
        $image_id_list = [];
        foreach ($product_list as $product)
        {
            $product_id_list[] = $product['product_id'];
            $image_id_list[] = $product['image_default_id'];
        }

        //获取商品图片
        $image_list = Images::getInstance()->getDefaultImages($image_id_list);
        $middle_img_list = [];
        if ($image_list)
        {
            foreach ($image_list as $value)
            {
                $middle_img_list[$value->image_id] = $value->middle_url;
            }
        }
        foreach ($product_list as $k => $product)
        {
            if (array_key_exists($product['image_default_id'], $middle_img_list))
            {
                $product_list[$k]['img'] = Yii::$app->params['img_url'] . $middle_img_list[$product['image_default_id']];
            }
            else
            {
                $product_list[$k]['img'] = '';
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

    public function getProductList($cat_id, $page, $type, $search = NUlL)
    {
        $product = array();
        switch ($type)
        {
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
        if ($search == 'search')
        {
            $sql = "select * from {{%goods}} g left join {{%product}} p on g.goods_id = p.goods_id "
                    . "join {{%images}} i on i.image_id = g.image_default_id  "
                    . "where g.name like :cat_id1 "
                    . " and p.is_default = 1  $order limit :pagesize,:offset";
        }
        else
        {
            $sql = "select * from {{%goods}} g left join {{%product}} p on g.goods_id = p.goods_id "
                    . "join {{%images}} i on i.image_id = g.image_default_id  "
                    . "where g.cat_id = :cat_id"
                    . " and p.is_default = 1  $order limit :pagesize,:offset";
        }
        $db = \yii::$app->db;
        $command = $db->createCommand($sql);
        if ($search == 'search')
        {
            $cat_id1 = '%' . $cat_id . '%';
            $command->bindParam(":cat_id1", $cat_id1, \yii\db\mssql\PDO::PARAM_STR);
        }
        else
        {
            $command->bindParam(":cat_id", $cat_id, \yii\db\mssql\PDO::PARAM_INT);
        }
        $command->bindParam(":pagesize", $pagesize, \yii\db\mssql\PDO::PARAM_INT);
        $command->bindParam(":offset", $offset, \yii\db\mssql\PDO::PARAM_INT);
        $productList = $command->queryAll();
//        $product['num'] = count($productList);
//        $product['product'] = $productList;
        return $productList;
//        $goods = Goods::find()->where('cat_id=:cat_id', [':cat_id' => $cat_id])->asArray()->all();
//        $goods_id = array();
//        foreach ($goods as $good) {
//            $goods_id[] = $good['goods_id'];
//        }
//        $product=  Product::find()->where(['in', 'goods_id', $goods_id])->asArray()->limit(10)->all();
//        var_dump($product);exit;
    }

    //热销商品
    public function getHotProducts()
    {
        $sql = "select * from {{%goods}} g left  "
                . "join {{%images}} i on i.image_id = g.image_default_id  "
                . "join {{%product}} p on g.goods_id = p.goods_id "
                . "group by g.goods_id order by g.buy_count desc limit 10 ";
        $db = \yii::$app->db;
        $command = $db->createCommand($sql);
        $HotProduct = $command->queryAll();
        return $HotProduct;
    }

    public function getProductNum($cat_id, $search = NULL)
    {

        if ($search == 'search')
        {
            $sql = "select * from {{%goods}} g left join {{%product}} p on g.goods_id = p.goods_id "
                    . "join {{%images}} i on i.image_id = g.image_default_id  "
                    . "where g.name like :cat_id1 "
                    . " and p.is_default = 1 ";
        }
        else
        {
            $sql = "select * from {{%goods}} g left join {{%product}} p on g.goods_id = p.goods_id "
                    . "join {{%images}} i on i.image_id = g.image_default_id  "
                    . "where g.cat_id = :cat_id"
                    . " and p.is_default = 1";
        }
        $db = \yii::$app->db;
        $command = $db->createCommand($sql);
        if ($search == 'search')
        {
            $cat_id1 = '%' . $cat_id . '%';
            $command->bindParam(":cat_id1", $cat_id1, \yii\db\mssql\PDO::PARAM_STR);
        }
        else
        {
            $command->bindParam(":cat_id", $cat_id, \yii\db\mssql\PDO::PARAM_INT);
        }
        $productList = $command->queryAll();
        return count($productList);
    }

}
