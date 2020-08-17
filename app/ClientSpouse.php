<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSpouse extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'physical_address',
        'postal_address',
        'marriage_date',
        'marriage_place',
        'nationality',
        'is_citizen',
        'occupation',
    ];
}
