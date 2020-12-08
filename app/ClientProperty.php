<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProperty extends Model
{
    protected $fillable = [
        'matrimony_id',
        'propertiable_id',
        'propertiable_type',
    ];

    public function propertiable()
    {
        return $this->morphTo();
    }
}
