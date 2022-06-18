<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class CommentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'       => 'required|exists:users,id',
            'product_name'  => 'required|string',
            'content'       => 'required|string'
        ];
    }
}