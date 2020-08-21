<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conveyancing extends Model
{
    protected $table = 'conveyancing';

    protected $fillable = [
        'number',
        'client_id',
        'client_type',
        'other_id',
        'other_type',
        'transaction_id',
    ];

    public function transaction()
    {
        return $this->belongsTo(PlotTransaction::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
