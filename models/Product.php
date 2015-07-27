<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property string $product_id
 * @property string $goods_id
 * @property string $bn
 * @property string $price
 * @property string $mktprice
 * @property string $product_name
 * @property string $goods_type
 * @property string $spec_info
 * @property integer $is_default
 * @property integer $marketable
 * @property integer $is_index
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'is_default', 'marketable', 'is_index'], 'integer'],
            [['price', 'mktprice'], 'number'],
            [['goods_type', 'spec_info'], 'string'],
            [['bn'], 'string', 'max' => 30],
            [['product_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'goods_id' => 'Goods ID',
            'bn' => 'Bn',
            'price' => 'Price',
            'mktprice' => 'Mktprice',
            'product_name' => 'Product Name',
            'goods_type' => 'Goods Type',
            'spec_info' => 'Spec Info',
            'is_default' => 'Is Default',
            'marketable' => 'Marketable',
            'is_index' => 'Is Index',
        ];
    }

    public function getIndexProductList($cat_list)
    {
        $db = \Yii::$app->db;
        $sql = "SELECT p.product_name,p.goods_type,p.product_id,p.price,g.buy_count,g.image_default_id FROM pzf_goods AS g LEFT JOIN ".self::tableName()." as p ON g.goods_id=p.goods_id WHERE g.is_index=1 AND cat_id in (".implode(',', $cat_list).") AND p.is_default AND p.marketable=1";
        $command = $db->createCommand($sql);
        //$command->bindParam(":cat_id_str", implode(',', $cat_list));
        $list = $command->queryAll();
        return $list;
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(), ['goods_id'=>'goods_id'])->asArray();
    }

    /**
     * 实例化对象
     * @return Category
     */
    public static function getInstance()
    {
        return new self;
    }
}
