<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmr_std',
        'jdl_std',
    ];

    public function meeting_materials()
    {
        return $this->hasOne(MeetingMaterial::class, 'old_std_id');
    }

    public function meeting_material_statuses()
    {
        return $this->hasOne(MeetingMaterial::class, 'old_std_id');
    }

    public function revision_decrees()
    {
        return $this->belongsTo(RevisionDecree::class, 'sk_id');
    }
}
