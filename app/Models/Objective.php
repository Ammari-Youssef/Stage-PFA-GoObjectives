<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    protected $fillable = [
        'UserID',
        'ObjectiveTitle',
        'Description',
        'CategoryID',
        'DesiredResult',
        'TypeID',
        'isDone',
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
        return $this->belongsToMany(Level::class, 'level_objective', 'objective_id', 'level_id');
    }

    public function Motives()
    {
        return $this->hasMany(Motive::class);
    }

    public function results()
    {
        return $this->morphMany(Result::class, 'resultable');
    }


    public function typeObjective(){
        return $this->hasOne(TypeObjective::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function subobjectives()
    {
        return $this->hasMany(Objective::class, 'parent_id');
    }

    // Relationship: An objective belongs to a parent objective
    public function parentObjective()
    {
        return $this->belongsTo(Objective::class, 'parent_id');
    }
}
