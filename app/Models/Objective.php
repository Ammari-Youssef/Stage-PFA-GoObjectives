<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    protected $fillable = [
        'ObjectiveTitle', 'Description', 'Category', 'isDone',
        'ExpectedResult', 'Type', 'DateDebut', 'Importance',
        'Planning', 'PlanningType', 'PlanningDays', 'RestDays',
        'DureeEstimee',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'ObjectiveID');
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function Motives()
    {
        return $this->hasMany(Motive::class);
    }
    
    public function Results()
    {
        return $this->hasMany(Result::class);
    }
}
