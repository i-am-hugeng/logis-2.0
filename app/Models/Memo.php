<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmr_nodin',
        'jenis_nodin',
        'nmr_kepka',
    ];

    public function meeting_schedules()
    {
        return $this->belongsTo(MeetingSchedule::class, 'meeting_id');
    }

    public function memo_histories()
    {
        return $this->hasMany(MemoHistory::class, 'memo_id');
    }
}
