<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motive extends Model
{
    use HasFactory;
    protected $fillable = ['ObjectiveID', 'MotiveType', 'MotiveTitle', 'MotiveDescription'];

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }
}
