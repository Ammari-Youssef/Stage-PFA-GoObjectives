<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'Health & fitness',   'Relationships',   'Spirituality',   'Environnement',   'FreeTime',   'Work & business',   'Feelings',     'Money & finance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
