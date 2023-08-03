<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_nodin',
    ];

    public function memos()
    {
        return $this->belongsTo(Memo::class, 'memo_id');
    }
}
