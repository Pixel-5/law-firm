<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileNoteForm extends Model
{
    protected $fillable = [
        'litigation_id',
        'name',
        'matter',
        'other_party',
        'other_attorneys',
        'attorney',
        'start_time',
        'end_time',
        'venue',
        'description',
        'time_taken',
        'hourly_rate',
    ];
}
