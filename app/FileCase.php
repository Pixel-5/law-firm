<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class FileCase extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'cases';

    protected static $logName = 'case';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'plaintiff',
        'defendant',
        'details',
        'status',
        'number',
        'docs',
    ];

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

    public function schedule()
    {
        return $this->hasOne(Schedule::class,'case_id');
    }

    protected function getArrayAttributeByKey($key)
    {
        return 'slug';
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Case has been {$eventName}";
    }
}
