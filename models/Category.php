<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property string $cat_id
 * @property string $parent_id
 * @property string $cat_name
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['cat_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'parent_id' => 'Parent ID',
            'cat_name' => 'Cat Name',
        ];
    }

    public function getCategoryList()
    {
        $list = self::find()->all();
        return $list;
    }

    /**
     * 获取某分类下的所有子类
     */
    public function getChildrenCat($cat_id){
        $db = \Yii::$app->db;
        $sql = "SELECT cat_id FROM ".self::tableName()." WHERE parent_id=:parent_id";
        $command = $db->createCommand($sql);
        $command->bindParam(":parent_id", $cat_id);
        $res = $command->queryAll();
        $arr = array();
        foreach ($res as $val) {
            $sql = "SELECT count(*) as num FROM ".self::tableName()." WHERE parent_id=:parent_id";
            $command = $db->createCommand($sql);
            $command->bindParam(":parent_id", $val['cat_id']);
            $num = $command->queryScalar();
            if ($num > 0) {//适用于含有二级子分类的情况
                $arr[] = $val['cat_id'];
                $sql = "SELECT cat_id FROM ".self::tableName()." WHERE parent_id=:parent_id";
                $command = $db->createCommand($sql);
                $command->bindParam(":parent_id", $val['cat_id']);
                $result = $command->queryAll();
                foreach ($result as $val) {
                    $arr[] = $val['cat_id'];
                }
            } else {//适用于只有一级子分类的情况
                $arr[] = $val['cat_id'];//当前一级子分类ids
            }
        }
        //$arr[] = $cat_id;
        $arr = array_unique($arr);//去除重复
        return $arr;
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
