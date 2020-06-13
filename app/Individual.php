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

class Individual extends Model
{
    use SoftDeletes, HasSlug, Notifiable, LogsActivity, SoftCascadeTrait;

    protected static $logName = 'individual';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $softCascade = ['retainer'];

    protected static $logAttributes = [
        'surname',
        'name',
        'dob',
        'identifier',
        'gender',
        'physical_address',
        'tel',
        'cell',
        'fax',
        'email',
        'preferred_email',
        'preferred_contact',
        'marital_status',
        'name_spouse',
        'name_next_kin',
        'contact_next_kin',
        'preferred_invoice',
        'docs',
    ];

    protected $fillable = [
        'name',
        'number',
        'surname',
        'name',
        'dob',
        'identifier',
        'gender',
        'physical_address',
        'tel',
        'cell',
        'fax',
        'email',
        'preferred_email',
        'preferred_contact',
        'marital_status',
        'name_next_kin',
        'contact_next_kin',
        'preferred_invoice',
        'docs',
        'nationality',
        'is_citizen',
        'occupation',
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
            ->generateSlugsFrom(['name','surname'])
            ->saveSlugsTo('slug');
    }
}
