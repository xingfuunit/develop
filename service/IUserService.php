<?php

namespace app\service;

/**
 * 用户业务逻辑接口
 */
interface IUserService{
    public function getAllUsers();
    public function getUserById($id);
}
