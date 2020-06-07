<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use SoftDeletes, LogsActivity;

    public $table = 'permissions';

    protected static $logName = 'permission';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = ['title',];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "Permission has been {$eventName}";
//    }
}
