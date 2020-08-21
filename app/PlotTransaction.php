<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlotTransaction extends Model
{
    protected $fillable = [
        'transaction_type',
        'client_transaction_type',
        'other_transaction_type',
        'plot_id'
    ];

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }
}
