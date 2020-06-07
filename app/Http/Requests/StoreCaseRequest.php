<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class StoreCaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('case_create'), Response::HTTP_FORBIDDEN,
            'You do not have permission to create case');
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
            'plaintiff'      => [
                'required',
            ],
            'defendant'      => [
                'required',
            ],
            'details'        => [
                'required',
            ],
            'number'         => [
                'required',
            ],
        ];
    }
}
