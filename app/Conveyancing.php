<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conveyancing extends Model
{
    protected $fillable = [
        'number',
        'client_id',
        'client_type'
    ];
}
