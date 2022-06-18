<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($request)
    {
        $user = $this->userRepository->register($request);

        return $user;
    }

    public function login($request)
    {
        $user = $this->userRepository->login($request);

        return $user;
    }

    public function getUser($id)
    {
        $user = $this->userRepository->getUserById($id);

        return $user;
    }
}