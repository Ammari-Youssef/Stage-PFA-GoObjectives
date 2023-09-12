<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motive extends Model
{
    use HasFactory;
    protected $fillable = ['objective_id', 'type', 'title', 'description'];

    public function objective()
    {
        return $this->belongsTo(Objective::class,'objective_id');
    }
}
