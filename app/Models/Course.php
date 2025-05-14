<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'teacher_id', 'price', 'cat_id', 'status'];



    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')->withPivot('is_completed')->withTimestamps();
    }

}
