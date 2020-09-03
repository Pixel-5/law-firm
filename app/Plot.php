<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\SearchResult;

class Plot extends Model
{
    use SoftDeletes, SoftCascadeTrait;


    protected $softCascade = ['plot'];

    protected static $logAttributes = [
        'number',
        'situated_at',
        'title_deed',
        'category',
        'property_bounded',
        'notes',
        'purchase_price',
        'initial_payment',
    ];

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
