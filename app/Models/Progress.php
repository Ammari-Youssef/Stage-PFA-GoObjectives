<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserID', 
        'CategoryID', 
        'value', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
