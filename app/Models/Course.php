<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'teacher_id',
        'price',
        'cat_id',
        'status',
        'difficulty',       // уровень сложности
        'duration',         // продолжительность
        'is_certified',     // сертификат (true/false)
        'requirements',     // предварительные знания
    ];



    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

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

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function purchases()
    {
        return $this->hasMany(CoursePurchase::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }




}
