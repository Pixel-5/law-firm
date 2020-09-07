<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientChildren extends Model
{
    protected $table = 'client_children';

    protected $fillable = [
        'matrimony_id',
        'name',
        'dob',
        'school',
        'standard',
        'residence_place',
        'marital',
        'non_marital',
    ];

    public function matrimony()
    {
        return $this->belongsTo(Matrimony::class);
    }
}
