<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Litigation extends Model
{
    protected $table = 'litigation';

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
        return $this->hasOne(MatrimonyForm::class);
    }
}
