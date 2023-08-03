<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function meeting_schedules()
    {
        return $this->belongsTo(MeetingSchedule::class, 'meeting_id');
    }
}
