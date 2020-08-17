<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEventRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('schedule_delete'), Response::HTTP_FORBIDDEN,
            'You do not have permission to delete schedules');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:events,id',
        ];
    }
}
