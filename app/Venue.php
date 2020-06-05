<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Venue extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'location'];

    protected static $logName = 'venue';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $fillable = [
        'name',
        'location'
    ];
//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "Venue has been {$eventName}";
//    }
}
