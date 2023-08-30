<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'ObjectiveID','TaskTitle', 'TaskDescription', 'TaskDate', 
    ];

    // Define the relationship with the Objective model
    public function objective()
    {
        return $this->belongsTo(Objective::class, 'ObjectiveID');
    }

    public function results()
    {
        return $this->morphMany(Result::class, 'resultable');
    }
}
