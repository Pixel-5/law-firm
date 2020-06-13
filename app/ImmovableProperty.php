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
        'title_holder',
    ];
}
