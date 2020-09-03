<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Client extends Model implements Searchable
{
    use SoftDeletes, Notifiable, LogsActivity, SoftCascadeTrait;

    protected static $logName = 'client';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'clientable.number',
        'clientable.name',
        'clientable.postal_address',
        'clientable.physical_address',
    ];

    protected $softCascade = ['litigation','conveyancing'];


    protected $fillable = [
        'clientable_id',
        'clientable_type'
    ];

    public function clientable()
    {
        return $this->morphTo();
    }

    public function conveyancing()
    {
        return $this->hasMany(Conveyancing::class);
    }

    public function litigation()
    {
        return $this->hasMany(Litigation::class);
    }

    /**
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        $url = route('files.show', $this->id);
        return new SearchResult(
            $this,
            $this->number,
            $url
        );
    }
}
