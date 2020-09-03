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

class Company extends Model implements Searchable
{
    use SoftDeletes, HasSlug, Notifiable, LogsActivity, SoftCascadeTrait;

    protected static $logName = 'company';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;


    protected static $logAttributes = [
        'name',
        'entity',
        'doi',
        'physical_address',
        'postal_address',
        'director_name',
        'director_physical_address',
        'director_postal_address',
        'tel',
        'cell',
        'fax',
        'email',
        'preferred_email',
        'preferred_contact',
        'contact_person',
        'directors_postal_address',
        'directors_physical_address',
        'alternative_contact',
        'preferred_invoice',
        'docs',
        'agreement_service',
    ];

    protected $softCascade = ['retainer'];

    protected $fillable = [
        'number',
        'name',
        'entity',
        'physical_address',
        'postal_address',
        'director_name',
        'director_physical_address',
        'director_postal_address',
        'tel',
        'cell',
        'fax',
        'email',
        'preferred_email',
        'preferred_contact',
        'contact_person',
        'directors_postal_address',
        'directors_physical_address',
        'alternative_contact',
        'preferred_invoice',
        'docs',
        'agreement_service',
    ];

    public function routeNotificationForNexmo($notification)
    {
        return '+267'.$this->cell;
    }

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
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function client()
    {
        return $this->morphOne('App\Client', 'clientable');
    }
}
