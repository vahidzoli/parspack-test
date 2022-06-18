<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function userHasComment(User $user, Product $product)
    {
        $comments = Comment::query()->where('user_id', $user->id)->where('product_name', $product->name)->get();

        if(count($comments) < 2){
            return true;
        }else{
            return false;
        }
    }
}
