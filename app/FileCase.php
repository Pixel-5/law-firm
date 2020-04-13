<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileCase extends Model
{
    use SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'file_id',
        'plaintiff',
        'defendant',
        'details',
        'status',
        'number',
        'docs',
        'user_id'
        ];

    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
