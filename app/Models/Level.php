<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public function objectives()
    {
        return $this->belongsToMany(Objective::class, 'level_objective', 'level_id', 'objective_id');
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }
}
