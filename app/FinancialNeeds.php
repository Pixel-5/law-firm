<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialNeeds extends Model
{
    protected $fillable = [
        'matrimony_id',
        'school_expenses',
        'transportation',
        'clothes',
        'groceries',
        'house_keeper',
        'shelter'
    ];

    public function matrimony()
    {
        return $this->belongsTo(Matrimony::class);
    }
}
