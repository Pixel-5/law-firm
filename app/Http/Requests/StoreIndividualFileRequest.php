<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StoreIndividualFileRequest extends FormRequest
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
            'surname' => [
                'required',
            ],
            'dob' => [
                'required',
               // 'date_format:' . config('panel.date_format'),
            ],
            'identifier'   => [
                'required',
            ],
            'gender' => [
                'required',
            ],
            'physical_address' => [
                'required',
            ],
            'postal_address' => [
                'required',
            ],
            'tel' => [
                'required',
            ],
            'cell' => [
                'required',
            ],
            'fax' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'preferred_email' => [
                'required',
            ],
            'preferred_contact' => [
                'required',
            ],
            'marital_status' => [
                'required',
            ],
            'name_spouse' => [
                'required',
            ],
            'name_next_kin' => [
                'required',
            ],
            'preferred_invoice' => [
                'required',
            ],
        ];
    }
}
