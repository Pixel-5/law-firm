<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Litigation extends Model
{
    protected $fillable = [
        'number',
        'client_id',
        'category',
        'initial_consultation_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
