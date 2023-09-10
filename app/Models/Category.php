<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }
}
