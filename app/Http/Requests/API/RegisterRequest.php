<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|max:225',
            'email'     => 'required|string|email|unique:users',
            'password'  => 'required|string|min:6'
        ];
    }
}