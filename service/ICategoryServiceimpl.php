<?php

namespace app\service;

use app\models\Category;
use yii\base\Object;
/**
 *广告业务逻辑实现
 *实现广告业务逻辑接口
 *
 */
class ICategoryServiceimpl extends Object implements ICategoryService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCateTree()
    {
        $list = Category::getInstance()->getCategoryList();
        $items = [];
        foreach ($list as $category) {
            $items[$category->cat_id] = $category->getattributes();
        }

        $tree = [];
        foreach ($items as $item) {
            if (isset($items[$item['parent_id']])) {
                $items[$item['parent_id']]['son'][] = &$items[$item['cat_id']];
            } else {
                $tree[] = &$items[$item['cat_id']];
            }
        }
        return $tree;
    }

    public function getChildrenCat($cat_id)
    {
        $cat_list = Category::getInstance()->getChildrenCat(intval($cat_id));
        return $cat_list;
    }
}

