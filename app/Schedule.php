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
        'name',
        'start_time',
        'end_time',
        'venue',
        'notes',
        'case.number'
    ];

    protected $dates = [
        'end_time',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'end_time',
        'start_time',
        'venue',
        'user_id',
        'notes',
        'scheduleable_id',
        'scheduleable_type',
        'category'
    ];

    public function saveQuietly()
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }
    public function case()
    {
        return $this->belongsTo(FileCase::class);
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
