<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class StoreFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('file_create'), Response::HTTP_FORBIDDEN,
            'You do not have permission to create file');
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
