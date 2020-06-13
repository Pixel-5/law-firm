<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Retainer extends Model
{
    use SoftDeletes, HasSlug, Notifiable, LogsActivity, SoftCascadeTrait;

    protected static $logName = 'retainer';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'individual.name',
        'company.name',
    ];

    protected $fillable = [
        'number',
        'individuals_id',
        'companies_id',
    ];

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
            ->generateSlugsFrom('number')
            ->saveSlugsTo('slug');
    }
}
