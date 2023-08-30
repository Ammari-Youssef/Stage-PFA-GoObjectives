<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    protected $fillable = [
        'UserID',
        'CategoryID',
        'ObjectiveTitle',
        'Description',
        'isDone',
        'ExpectedResult',
        'Type',
        'NumberValue',
        'LogicOption',
        'InitialDuration',
        'TargetDuration',
        'DateStart',
        'DateDeadline',
        'Importance',
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
        return $this->belongsTo(Level::class);
    }

    public function Motives()
    {
        return $this->hasMany(Motive::class);
    }

    public function results()
    {
        return $this->morphMany(Result::class, 'resultable');
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }
}
