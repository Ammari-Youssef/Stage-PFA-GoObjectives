<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserID', 'health_fitness', 'relationships', 'spirituality', 'environment',
        'free_time', 'work_business', 'feelings', 'money_finance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
