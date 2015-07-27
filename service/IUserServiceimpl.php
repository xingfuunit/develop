<?php

namespace app\service;

use app\models\User;
use yii\base\Object;
/**
 *用户业务逻辑实现
 *实现用户业务逻辑接口
 *
 */
class IUserServiceimpl extends Object implements IUserService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $list = User::getInstance()->getAllUsers();
        return $list ? $list : [];
    }

    public function getUserById($id)
    {
        return User::findOne($id);
    }
}
