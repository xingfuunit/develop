<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%advert}}".
 *
 * @property string $advert_id
 * @property string $ad_position
 * @property string $ad_type
 * @property string $title
 * @property string $img_url
 * @property string $link_url
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%advert}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_position'], 'required'],
            [['ad_type'], 'string'],
            [['ad_position'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 200],
            [['img_url', 'link_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'advert_id' => 'Advert ID',
            'ad_position' => 'Ad Position',
            'ad_type' => 'Ad Type',
            'title' => 'Title',
            'img_url' => 'Img Url',
            'link_url' => 'Link Url',
        ];
    }


    /**
     * 获取广告列表
     */
    public function getAdvertList($ad_position)
    {
        if ($ad_position) {
            $advert_list = self::find()->where(['ad_position' => $ad_position])->all();
        } else {
            $advert_list = self::find()->all();
        }
        return $advert_list;
    }

    /**
     * 实例化对象
     * @return Advert
     */
    public static function getInstance()
    {
        return new self;
    }
}
