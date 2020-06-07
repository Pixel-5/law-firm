<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Venue extends Model
{
    use HasSlug, LogsActivity, SoftDeletes;

    protected static $logAttributes = ['name', 'location'];

    protected static $logName = 'venue';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $fillable = [
        'name',
        'location',
    ];
    protected function getArrayAttributeByKey($key)
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "Venue has been {$eventName}";
//    }
}
