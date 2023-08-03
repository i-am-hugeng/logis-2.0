<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionDecree extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic_identifikasi',
        'nmr_sk',
        'uraian_sk',
        'tgl_terbit_sk',
        'tgl_terima_sk',
    ];

    public function new_standards()
    {
        return $this->hasMany(NewStandard::class, 'sk_id');
    }

    public function old_standards()
    {
        return $this->hasMany(OldStandard::class, 'sk_id');
    }

    public function standard_traits()
    {
        return $this->hasMany(StandardTrait::class, 'sk_id');
    }

    public function identification_statuses()
    {
        return $this->hasMany(IdentificationStatus::class, 'sk_id');
    }

    public function identifications()
    {
        return $this->hasMany(Identification::class, 'sk_id');
    }
}
