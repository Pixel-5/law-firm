<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN,
            'You do not have permission to update profile');
        return true;
    }

    public function rules()
    {
        return [
            'email'   => [
                'required',
                'unique:users,email,' .$this->user()->id
            ],
            'password' => [
                'nullable',
                'min:8',
                'confirmed'
            ],
        ];
    }
}
