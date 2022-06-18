<?php

namespace App\Http\Controllers\API;

use App\Dtos\CommentDTO;
use App\Events\CommentCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CommentRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->middleware('auth:api');

        $this->commentRepository = $comment;
    }

    /**
     * Create a comment.
     *
     * @param  CommentRequest  $request
     * 
     * @return json
     */
    public function create(CommentRequest $request): JsonResponse
    {
        $cmt = $this->commentRepository->create($request->all());
        $cmt = CommentDTO::make($cmt);

        CommentCreated::dispatch($cmt);

        return response()->json([
            'message' => 'Comment successfully added'
        ], Response::HTTP_CREATED);
    }
}
