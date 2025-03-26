<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'video', 'course_id', 'is_preview'];

    public function course()
    {
        return $this->belongsTo(Course::class)->where('status', 'approved');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

}
