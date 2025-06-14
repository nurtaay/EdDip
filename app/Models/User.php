<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
        'bio',
        'experience_years',
        'education',
        'specialization',
        'languages',
        'certificates',
        'linkedin_url',
        'website_url',
        'video_intro_url',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function earnings()
    {
        return $this->hasMany(Earning::class, 'teacher_id');
    }

    public function isTeacher()
    {
        // Пример: если в таблице users есть поле role, где 'teacher' – преподаватель
        return $this->role === 'teacher';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    public function isStudent()
    {
        return $this->role === 'user';
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('is_completed')
            ->withTimestamps();
    }

    public function purchasedCourses()
    {
        return $this->hasManyThrough(
            \App\Models\Course::class,
            \App\Models\CoursePurchase::class,
            'user_id',
            'id',
            'id',
            'course_id'
        );
    }


    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user')->withTimestamps();
    }

    public function purchases()
    {
        return $this->hasMany(CoursePurchase::class);
    }



}
