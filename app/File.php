<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    use SoftDeletes, Notifiable, LogsActivity;

    protected static $logName = 'file';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
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

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  Notification  $notification
     * @return string
     */

    public function routeNotificationForNexmo($notification)
    {
        return '+267'.$this->contact;
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "File has been {$eventName}";
    }
}
