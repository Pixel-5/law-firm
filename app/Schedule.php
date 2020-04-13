<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    public $table = 'schedules';

    protected $dates = [
        'end_time',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const RECURRENCE_RADIO = [
        'none'    => 'None',
        'daily'   => 'Daily',
        'weekly'  => 'Weekly',
        'monthly' => 'Monthly',
    ];

    protected $fillable = [
        'name',
        'end_time',
        'venue',
        'case_id',
        'user_id',
        'notes',
        'schedule_id',
        'start_time',
        'recurrence',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'schedule_id', 'id');
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(
            config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(
            config('panel.date_format') . ' ' . config('panel.time_format'),
            $value)->format('Y-m-d H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(
            config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(
            config('panel.date_format') . ' ' . config('panel.time_format'),
            $value)->format('Y-m-d H:i:s') : null;
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

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
}
