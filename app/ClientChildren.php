<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientChildren extends Model
{
    protected $fillable = [
        'name',
        'dob',
        'school',
        'standard',
        'residence_place',
        'marital',
        'non_marital',
    ];
}
