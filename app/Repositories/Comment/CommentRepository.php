<?php

namespace App\Repositories\Comment;

use App\Exceptions\CommentLimitException;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Repositories\Product\ProductRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    protected $commentModel;
    protected $productRepository;
    protected $userPolicy;

    public function __construct(
        Comment $comment,
        ProductRepositoryInterface $product,
        UserPolicy $policy
        )
    {
        $this->commentModel = $comment;
        $this->productRepository = $product;
        $this->userPolicy = $policy;
    }

    public function create($request)
    {
        $user = User::where('id', $request['user_id'])->first();
        $product = Product::where('name', $request['product_name'])->first();
        
        if(is_null($product)) {
            $this->productRepository->create([
                'name'  => $request['product_name']
            ]);
        } else {
            if(!$this->userPolicy->userHasComment($user, $product)) {

                throw new CommentLimitException();
            }        
        }
        
        return $this->commentModel->create($request);
    }
}