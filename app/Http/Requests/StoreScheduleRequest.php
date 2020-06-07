<?php

namespace App\Http\Requests;

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

    public function rules()
    {
        return [
            'venue' => [
                'required',
            ],
            'case_id' => [
                'required',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'recurrence' => [
                'required',
            ],
        ];
    }
}
