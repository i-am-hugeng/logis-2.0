<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionStatus extends Model
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
