<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingMaterial extends Model
{
    use HasFactory;

    public function transition_times()
    {
        return $this->hasOne(TransitionTime::class, 'material_id');
    }

    public function discussion_results()
    {
        return $this->hasOne(DiscussionResult::class, 'material_id');
    }

    public function meeting_schedules()
    {
        return $this->belongsTo(MeetingSchedule::class, 'meeting_id');
    }

    public function old_standards()
    {
        return $this->belongsTo(OldStandard::class, 'old_std_id');
    }
}
