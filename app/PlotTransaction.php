<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlotTransaction extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected $softCascade = ['plot'];

    protected $fillable = [
        'conveyancing_id',
        'transaction_type',
        'client_transaction_type',
        'other_transaction_type',
    ];

    public function plot()
    {
        return $this->hasOne(Plot::class);
    }

    public function conveyancing()
    {
        return $this->belongsTo(Conveyancing::class);
    }
}
