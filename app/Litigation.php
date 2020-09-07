<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Litigation extends Model implements Searchable
{
    use SoftDeletes, LogsActivity, SoftCascadeTrait;

    protected $table = 'litigation';

    protected static $logName = 'litigation';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $softCascade = ['consultation','notes','matrimony','schedule'];

    protected static $logAttributes = [
        'number',
        'user.name',
        'status',
        'category',
        'consultation.number',
        'client.name',
        'client.email'
    ];

    protected $fillable = [
        'number',
        'client_id',
        'category',
        'initial_consultation_id',
        'user_id',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->morphOne(Schedule::class,'scheduleable');
    }

    public function consultation()
    {
        return $this->hasOne(InitialConsultationForm::class);
    }

    public function notes()
    {
        return $this->hasMany(FileNoteForm::class);
    }

    public function matrimony()
    {
        return $this->hasOne(Matrimony::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = 'Lawyer' == Auth::user()->roles->first()->title? route('lawyer.litigation.show', $this->id):
            route('admin.client.show',$this->client->id);
        return new SearchResult(
            $this,
            $this->number,
            $url
        );
    }
}
