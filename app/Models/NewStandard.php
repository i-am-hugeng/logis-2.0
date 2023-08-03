<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmr_std',
        'jdl_std',
        'tahun_std',
    ];

    public function revision_decrees()
    {
        return $this->belongsTo(RevisionDecree::class, 'sk_id');
    }
}
