<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('schedule_create'), Response::HTTP_FORBIDDEN,
            'You do not have permissions to create schedules');
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        //dd($validator->errors());
        return redirect()
            ->route('lawyer.schedule.create')
            ->withErrors($validator)
            ->withInput();
    }

    public function messages()
    {
        return [
            'scheduleable_id.required' => 'The '. request('scheduleable_type').' number field is required.',
        ] ;
    }


    public function rules()
    {
        return [
            'schedule_appointment' =>[
                'required',
            ],
            'venue' => [
                'required_if:schedule_appointment,court',
                'required_if:schedule_appointment,client',
            ],
            'attorney_id' => [
                'required',
            ],
            'scheduleable_type' =>[
                'required',
            ],
            'scheduleable_id' =>[
                'required',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
