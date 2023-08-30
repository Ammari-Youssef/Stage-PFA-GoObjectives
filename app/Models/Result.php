<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function resultable()
    {
        return $this->morphTo();
    }
    
    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }
}
