<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $goods_id
 * @property string $name
 * @property string $cat_id
 * @property string $intro
 * @property integer $nostore_sell
 * @property string $params
 * @property string $comments_count
 * @property string $buy_count
 * @property string $image_default_id
 * @property string $image_ids
 * @property string $uptime
 */
class Goods extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cat_id', 'nostore_sell', 'comments_count', 'buy_count', 'uptime'], 'integer'],
            [['intro', 'params'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['image_default_id', 'image_ids'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'goods_id' => 'Goods ID',
            'name' => 'Name',
            'cat_id' => 'Cat ID',
            'intro' => 'Intro',
            'nostore_sell' => 'Nostore Sell',
            'params' => 'Params',
            'comments_count' => 'Comments Count',
            'buy_count' => 'Buy Count',
            'image_default_id' => 'Image Default ID',
            'image_ids' => 'Image Ids',
            'uptime' => 'Uptime',
        ];
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['goods_id' => 'goods_id'])->asArray();
    }

}
