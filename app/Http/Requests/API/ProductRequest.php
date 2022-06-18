<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|unique:products',
            'quantity'  => 'required|numeric'
        ];
    }
}