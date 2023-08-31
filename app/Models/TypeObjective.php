<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeObjective extends Model
{
   protected $fillable=[
      "Type",
      "NumberValue",
   ];
    use HasFactory;

    public function objectives() {
        return $this->hasMany(Objective::class);
    }
}
