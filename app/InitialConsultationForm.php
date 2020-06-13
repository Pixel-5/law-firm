<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InitialConsultationForm extends Model
{
    protected $fillable = [
        'litigation_id',
        'name',
        'number',
        'file_no',
        'other_party',
        'attorney_id',
        'start_time',
        'end_time',
        'venue',
        'description'
    ];
}
