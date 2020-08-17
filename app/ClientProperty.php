<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProperty extends Model
{
    protected $fillable = [
        'client_id',
        'immovable_id',
        'movable_id',
    ];
}
