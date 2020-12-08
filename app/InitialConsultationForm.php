<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InitialConsultationForm extends Model
{
    protected $fillable = [
        'litigation_id',
        'number',
        'matter',
        'start_time',
        'end_time',
        'venue',
        'date',
        'description'
    ];

    public function litigation()
    {
        return $this->belongsTo(Litigation::class);
    }
}
