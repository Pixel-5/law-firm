<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    protected $fillable = [
        'plot_no',
        'situated_at',
        'title_deed',
        'property_bounded',
        'purchase_price',
        'initial_payment',
        'notes',
    ];

    public function transaction()
    {
        return $this->hasOne(PlotTransaction::class);
    }
}
