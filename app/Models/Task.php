<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'objective_id','title', 'description', 'date', 
    ];

    // Define the relationship with the Objective model
    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }

    //this was added to determine whether the fk id belongs to objective or task
    // public function results()
    // {
    //     return $this->morphMany(Result::class, 'resultable');
    // }
}
