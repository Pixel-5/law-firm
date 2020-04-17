<?php

namespace App\Http\Requests;

use App\Schedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'venue'       => [
                'required',
            ],
            'start_time' => [
                'required',
            ],
            'end_time'   => [
                'required',
            ],
            'recurrence' => [
                'required',
            ],
        ];
    }
}
