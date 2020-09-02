<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileNoteForm extends Model
{
    protected $fillable = [
        'number',
        'litigation_id',
        'other_party',
        'other_attorneys',
        'judge_name',
        'start_time',
        'end_time',
        'date',
        'venue',
        'description',
        'time_taken',
        'hourly_rate',
    ];

    public function litigation()
    {
        return $this->belongsTo(Litigation::class);
    }
}
