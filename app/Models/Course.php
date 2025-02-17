<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'teacher_id'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
