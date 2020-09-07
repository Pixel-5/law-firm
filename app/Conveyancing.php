<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Conveyancing extends Model implements Searchable
{
    use SoftDeletes, LogsActivity, SoftCascadeTrait;

    protected $table = 'conveyancing';

    protected static $logName = 'conveyancing';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $softCascade = ['transaction'];

    protected static $logAttributes = [
        'number',
        'user.name',
        'status',
        'transaction.transaction_type',
        'transaction.client_transaction_type',
        'transaction.other_transaction_type',
    ];

    protected $fillable = [
        'number',
        'client_id',
        'client_type',
        'other_id',
        'other_type',
        'transaction_id',
        'user_id',
        'status'
    ];

    public function transaction()
    {
        return $this->hasOne(PlotTransaction::class);
    }

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

    /**
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        $url = Auth::user()->roles->first()->title == 'Lawyer'? route('lawyer.conveyancing.show', $this->id):
        route('admin.client.show',$this->id);
        return new SearchResult(
            $this,
            $this->number,
            $url
        );
    }
}
