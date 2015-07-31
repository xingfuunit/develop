<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%images}}".
 *
 * @property string $image_id
 * @property string $thumb_url
 * @property string $original_url
 * @property string $large_url
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'thumb_url', 'original_url', 'large_url'], 'required'],
            [['image_id'], 'string', 'max' => 32],
            [['thumb_url', 'original_url', 'large_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'thumb_url' => 'Thumb Url',
            'original_url' => 'Original Url',
            'large_url' => 'Large Url',
        ];
    }

    public function getDefaultImages($image_id_list)
    {
        $res = self::find()->where(['image_id' => $image_id_list])->all();
        return $res;
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
