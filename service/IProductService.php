<?php

namespace app\service;

/**
 * 业务逻辑接口
 */
interface IProductService{
    public function getIndexProductListByCat($cat_id);
    public function getProductList($cat_id, $page, $type);
    public function getGoodsNum($cat_id);
}
