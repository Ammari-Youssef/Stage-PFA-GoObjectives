<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'planning_type_id',
        'selected_week_days', // This should be casted to JSON in your model
        'number_of_days',
        'number_of_rest_days',
    ];
    protected $casts = [
        'selected_week_days' => 'array',
    ];

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function level()
    {
        return $this->hasMany(Planning::class);
    }
    public function planningType()
    {
        return $this->belongsTo(PlanningType::class);
    }


    

}
