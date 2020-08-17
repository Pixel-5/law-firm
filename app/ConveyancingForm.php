<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConveyancingForm extends Model
{
    protected $fillable = [
        'conveyance_id',
        'name',
        'transaction_type',
        'plot_no',
        'situated_at',
        'title_deed',
        'property_bounded',
        'purchase_price',
        'initial_payment',
        'notes',
        'plot_transfer_id',
    ];
}
