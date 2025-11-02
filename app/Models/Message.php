<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'name',
        'phone',
        'message',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
