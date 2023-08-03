<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingMaterialStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function old_standards()
    {
        return $this->belongsTo(OldStandard::class, 'old_std_id');
    }
}
