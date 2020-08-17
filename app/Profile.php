<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Profile extends Model implements Searchable
{
    use SoftDeletes, Notifiable, HasSlug, LogsActivity;

    protected static $logName = 'profile';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $ignoreChangedAttributes = ['photo',];

    protected static $logAttributes =  [
        'user.name',
        'academic_awards',
        'skills',
        'ranking',
        'experience',
        'availability',
        'photo',
        'username',
    ];

    protected $fillable = [
        'user_id',
        'academic_awards',
        'skills',
        'ranking',
        'experience',
        'availability',
        'photo',
        'username',
    ];

    protected function getArrayAttributeByKey($key)
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('profile.show', $this->id);
        return new SearchResult(
            $this,
            $this->username,
            $url
        );
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('username')
            ->saveSlugsTo('slug');
    }
}
