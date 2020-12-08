<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\SearchResult;

class Plot extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected static $logAttributes = [
        'number',
        'situated_at',
        'title_deed',
        'category',
        'property_bounded',
        'notes',
        'purchase_price',
        'initial_payment',
        'transaction_id',
    ];

    protected $fillable = [
        'plot_no',
        'situated_at',
        'title_deed',
        'property_bounded',
        'purchase_price',
        'initial_payment',
        'notes',
        'plot_transaction_id'
    ];

    public function transaction()
    {
        return $this->belongsTo(PlotTransaction::class);
    }

}
