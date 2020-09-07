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
        'fully_paid_for'
    ];

    public function property()
    {
        return $this->morphOne(ClientProperty::class);
    }
}
