<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Schedule extends Model implements Searchable
{
    use SoftDeletes, LogsActivity;

    public $table = 'schedules';

    protected static $logName = 'schedule';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'scheduleable_id',
        'scheduleable_type',
        'category',
        'start_time',
        'end_time',
        'venue',
        'notes',
        'attorney_id'
    ];

    protected $dates = [
        'end_time',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'scheduleable_id',
        'scheduleable_type',
        'attorney_id',
        'category',
        'end_time',
        'start_time',
        'venue',
        'notes',
    ];

    public function saveQuietly()
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }

    public function scheduleable()
    {
        return $this->morphTo();
    }

    public function conveyancing()
    {
        return $this->belongsTo(Conveyancing::class);
    }

    public function litigation()
    {
        return $this->belongsTo(Litigation::class);
    }

//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "Schedule has been {$eventName}";
//    }
    public function getSearchResult(): SearchResult
    {
        $url = route('lawyer.schedule.show', $this->id);
        return new SearchResult(
            $this,
            $this->id,
            $url
        );
    }

    protected function getArrayAttributeByKey($key)
    {
        return 'id';
    }

}
