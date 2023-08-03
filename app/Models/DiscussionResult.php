<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_status',
        'catatan',
    ];

    public function meeting_materials()
    {
        return $this->belongsTo(MeetingMaterial::class, 'material_id');
    }
}
