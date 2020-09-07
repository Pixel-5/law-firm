<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImmovableProperty extends Model
{
    protected $fillable = [
        'plot_number',
        'type',
        'development',
        'value',
        'fully_paid_for',
    ];

    public function property()
    {
        return $this->morphOne(ClientProperty::class);
    }
}
