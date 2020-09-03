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

class Individual extends Model implements Searchable
{
    use SoftDeletes, HasSlug, Notifiable, LogsActivity, SoftCascadeTrait;

    protected static $logName = 'individual';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $softCascade = ['individual'];

    protected static $logAttributes = [
        'surname',
        'name',
        'dob',
        'identifier',
        'nationality',
        'gender',
        'physical_address',
        'postal_address',
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
        'slug',
        'dob',
        'identifier',
        'gender',
        'physical_address',
        'postal_address',
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
            ->generateSlugsFrom('number')
            ->saveSlugsTo('slug');
    }

    public function client()
    {
        return $this->morphOne('App\Client', 'clientable');
    }

    public function conveyancing()
    {
        return $this->hasMany(Conveyancing::class,'client_id');
    }
}
