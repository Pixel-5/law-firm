<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class FileCase extends Model implements Searchable
{
    use SoftDeletes, LogsActivity, SoftCascadeTrait;

    protected $table = 'cases';

    protected static $logName = 'case';

    protected $softCascade = ['schedule'];

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'plaintiff',
        'defendant',
        'details',
        'status',
        'number',
        'user.name',
        'docs',
    ];

    protected $fillable = [
        'file_id',
        'plaintiff',
        'defendant',
        'details',
        'status',
        'number',
        'docs',
        'user_id'
        ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class,'case_id');
    }

    protected function getArrayAttributeByKey($key)
    {
        return 'id';
    }

//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "Case has been {$eventName}";
//    }
    public function getSearchResult(): SearchResult
    {
        $url = route('cases.show', $this->id);
        return new SearchResult(
            $this,
            $this->number,
            $url
        );
    }
}
