<?php

namespace app\service;

/**
 * 业务逻辑接口
 */
interface ICategoryService{
    public function getCateTree();
    public function getChildrenCat($cat_id);
}
