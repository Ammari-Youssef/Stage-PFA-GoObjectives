<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'rating'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function calculateTotalProgressForCategory($categoryId)
    {
        $totalProgress = Progress::where('category_id', $categoryId)->sum('value');

        // You can add any additional logic or calculations here if needed.

        return $totalProgress;
    }


}
