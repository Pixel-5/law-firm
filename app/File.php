<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        "number",
        "name",
        "surname",
        "gender",
        "email",
        "dob",
        "contact",
        "postal_address",
        "physical_address",
        "docs"
    ];

    public function cases()
    {
        return $this->hasMany('App\FileCase');
    }
}
