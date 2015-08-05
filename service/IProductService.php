<?php

namespace app\service;

/**
 * 业务逻辑接口
 */
interface IProductService
{

    public function getIndexProductListByCat($cat_id);

    public function getProductList($cat_id, $page, $type, $search = NULL);

    public function getHotProducts();

    public function getProductNum($cat_id, $search = NULL);
//    public function searchProduct($keywords, $page, $type);
}
