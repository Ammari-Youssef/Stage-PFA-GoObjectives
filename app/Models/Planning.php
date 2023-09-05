<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;
    
    protected $fillable = ['type', 'week_days', 'numbers_of_days', 'number_of_rest_days'];

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function level()
    {
        return $this->hasMany(Planning::class);
    }

    

}
