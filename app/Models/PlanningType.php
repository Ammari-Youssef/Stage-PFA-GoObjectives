<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

}
