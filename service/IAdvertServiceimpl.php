<?php

namespace app\service;

use app\models\Advert;
use app\models\Images;
use yii;
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
            $image_id_list = [];
            foreach ($list as $key => $value) {
                $image_id_list[] = $value->img_url;
            }
            //获取商品图片
            $image_list = Images::getInstance()->getDefaultImages($image_id_list);
            $middle_img_list = [];
            if ($image_list) {
                foreach ($image_list as $value) {
                    $middle_img_list[$value->image_id] = $value->large_url;
                }
            }

            foreach ($list as $k => $v) {
                if (array_key_exists($v->img_url, $middle_img_list)) {
                    $list[$k]->img_url = Yii::$app->params['img_url'] . $middle_img_list[$v->img_url];
                } else {
                    $list[$k]->img_url = '';
                }
            }

            if ($ad_position) {
                $advert_list[$ad_position] = $list;
            } else {
                foreach ($list as $advert) {
                    $advert_list[$advert->ad_position][] = $advert->getattributes();
                }
            }
        }

        return $advert_list;
    }
}

