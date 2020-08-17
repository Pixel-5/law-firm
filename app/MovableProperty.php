<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovableProperty extends Model
{
    protected $fillable = [
       'type',
        'location',
        'possession',
        'value',
        'title_holder'
    ];
}
