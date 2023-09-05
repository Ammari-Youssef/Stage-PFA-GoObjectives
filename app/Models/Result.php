<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_value',
        'experience_time_value',
        'logic_result',
        'result_date',
        'comment',
        'objective_id', // Assuming you have a foreign key to relate to objectives
    ];

   
    public function resultable()
    {
        return $this->morphTo();
    }
    
    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }
}
