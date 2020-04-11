<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StoreFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'dob' => [
                'required',
               // 'date_format:' . config('panel.date_format'),
            ],
            'surname'   => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'gender' => [
                'required',
            ],
            'postal_address' => [
                'required',
            ],
            'physical_address' => [
                'required',
            ],
            'contact' => [
                'required',
            ]
        ];
    }
}
