<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'clientable_id',
        'clientable_type'
    ];

    public function clientable()
    {
        return $this->morphTo();
    }

    public function conveyancing()
    {
        return $this->hasMany(Conveyancing::class);
    }

    public function litigation()
    {
        return $this->hasMany(Litigation::class);
    }
}
