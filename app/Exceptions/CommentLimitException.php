<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommentLimitException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => 'You are not allow to send more comments'
        ], Response::HTTP_FORBIDDEN);
    }
}