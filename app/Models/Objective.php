<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Objective extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'desired_result',
        'type',
        'number_value',
        'initial_time',
        'target_time',
        'behavior_option',
        'importance',
        'start_date',
        'estimated_duration',
        'end_date',
        'is_done',
        'user_id',
        'objective_parent_id',
        'category_id',
        'planning_id',
    ];




    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'objective_id');
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function motive()
    {
        return $this->hasMany(Motive::class);
    }

    public function results()
    {
        return $this->HasMany(Result::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function subobjectives()
    {
        return $this->hasMany(Objective::class, 'objective_parent_id');
    }

    // Relationship: An objective belongs to a parent objective
    public function parentObjective()
    {
        return $this->belongsTo(Objective::class, 'objective_parent_id');
    }
}
