<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic_rapat',
        'tanggal_rapat',
    ];

    public function meeting_materials()
    {
        return $this->hasMany(MeetingMaterial::class, 'meeting_id');
    }

    public function memos()
    {
        return $this->hasMany(Memo::class, 'meeting_id');
    }

    public function discussion_statuses()
    {
        return $this->hasMany(DiscussionStatus::class, 'meeting_id');
    }

    public function memo_statuses()
    {
        return $this->hasMany(MemoStatus::class, 'meeting_id');
    }
}
