<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function revision_decrees()
    {
        return $this->belongsTo(RevisionDecree::class, 'sk_id');
    }
}
