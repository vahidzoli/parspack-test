<?php

namespace App\Services\User;

Interface UserServiceInterface
{
    public function register($request);

    public function login($request);

    public function getUser($id);
}