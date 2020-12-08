<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements Searchable
{
    use SoftDeletes, Notifiable, HasSlug, LogsActivity, SoftCascadeTrait;

    public $table = 'users';

    protected static $logName = 'user';

    protected static $logOnlyDirty = true;

    protected static $recordEvents = ['created','updated','deleted'];

    protected static $submitEmptyLogs = false;

    protected $softCascade = ['profile'];

    protected static $ignoreChangedAttributes = ['password','remember_token',];

    protected static $logAttributes =  [
        'name',
        'email',
        'surname',
        'contact',
        'profile.username'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'surname',
        'contact',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
    ];

//    public function getEmailVerifiedAtAttribute($value)
//    {
//        return $value ? Carbon::createFromFormat('Y-m-d H:i:s',
//            $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
//    }
//
//    public function setEmailVerifiedAtAttribute($value)
//    {
//        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(
//            config('panel.date_format') . ' ' . config('panel.time_format'),
//            $value)->format('Y-m-d H:i:s') : null;
//    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    protected function getArrayAttributeByKey($key)
    {
        return 'slug';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function conveyancing()
    {
        return $this->hasMany(Conveyancing::class);
    }

    public function litigation()
    {
        return $this->hasMany(Litigation::class);
    }

    public function userSchedule()
    {
        return $this->hasMany(
            Schedule::class,
            'attorney_id',
            'id'
        );
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

    public function getSearchResult(): SearchResult
    {
        $url = route('profile.show', $this->id);
        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name','surname'])
            ->saveSlugsTo('slug');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


}
