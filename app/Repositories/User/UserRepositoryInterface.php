<?php

namespace App\Repositories\User;

Interface UserRepositoryInterface
{
    public function register($request);

    public function login($request);

    public function getUserById($id);
}