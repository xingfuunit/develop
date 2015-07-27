<?php

namespace app\service;

use app\models\Advert;
use yii\base\Object;
/**
 *广告业务逻辑实现
 *实现广告业务逻辑接口
 *
 */
class IAdvertServiceimpl extends Object implements IAdvertService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAdvertList($ad_position = '')
    {
        $list = Advert::getInstance()->getAdvertList($ad_position);

        $advert_list = [];
        if ($list) {
            if ($ad_position) {
                $advert_list[$ad_position] = $list;
            } else {
                foreach ($list as $advert) {
                    $advert_list[$advert->ad_position] = $advert->getattributes();
                }
            }
        }

        return $advert_list;
    }
}

