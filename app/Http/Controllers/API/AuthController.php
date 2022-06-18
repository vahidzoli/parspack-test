<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $user)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->userService = $user;
    }

    /**
     * Register a user.
     *
     * @param  RegisterRequest  $request
     * 
     * @return json
     */
    public function register(RegisterRequest $request): jsonResponse
    {
        $user = $this->userService->register($request);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    /**
     * Login a user.
     *
     * @param  LoginRequest  $request
     * 
     * @return json
     */
    public function login(LoginRequest $request): jsonResponse
    {
        $token = $this->userService->login($request);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 1440
        ], Response::HTTP_OK);     
    }

    /**
     * Get a user info.
     *
     * @param  User  $user
     * 
     * @return json
     */
    public function getUserInfo(User $user): JsonResponse
    {
        $user = $this->userService->getUser($user->id);
       
        return response()->json($user, Response::HTTP_OK);
    }
}
