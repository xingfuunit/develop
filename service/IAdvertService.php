<?php

namespace app\service;

/**
 * 广告业务逻辑接口
 */
interface IAdvertService{
    public function getAdvertList($ad_type);
}
