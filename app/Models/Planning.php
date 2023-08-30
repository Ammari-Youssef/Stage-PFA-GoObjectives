<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;
    
    protected $fillable = ['type', 'weekdays', 'numbersDays', 'restDays'];

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }
}
