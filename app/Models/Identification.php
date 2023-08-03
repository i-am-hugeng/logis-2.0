<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    use HasFactory;

    protected $fillable = [
        'komtek',
        'sekre_komtek',
    ];

    public function standard_implementers()
    {
        return $this->hasMany(StandardImplementer::class, 'identifikasi_id');
    }

    public function revision_decrees()
    {
        return $this->belongsTo(RevisionDecree::class, 'sk_id');
    }
}
