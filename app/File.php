<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class File extends Model implements Searchable
{
    use SoftDeletes, HasSlug, Notifiable, LogsActivity, SoftCascadeTrait;

    protected static $logName = 'file';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'number',
        'name',
        'surname',
        'gender',
        'email',
        'dob',
        'contact',
        'postal_address',
        'physical_address',
        'docs',
    ];

    protected $softCascade = ['cases'];

    //
    protected $fillable = [
        'number',
        'name',
        'surname',
        'gender',
        'email',
        'dob',
        'contact',
        'postal_address',
        'physical_address',
        'docs',
    ];

    public function cases()
    {
        return $this->hasMany(FileCase::class);
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
//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "File has been {$eventName}";
//    }
    public function getSearchResult(): SearchResult
    {
        $url = route('files.show', $this->id);

        return new SearchResult(
            $this,
            $this->number,
            $url
        );
    }
    protected function getArrayAttributeByKey($key)
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name','surname'])
            ->saveSlugsTo('slug');
    }
}
