<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardTrait extends Model
{
    use HasFactory;

    protected $fillable = [
        'sifat_std',
    ];

    public function revision_decrees()
    {
        return $this->belongsTo(RevisionDecree::class, 'sk_id');
    }
}
