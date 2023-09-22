<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description','status', 'objective_id', 'planning_id',
    ];

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }
}
