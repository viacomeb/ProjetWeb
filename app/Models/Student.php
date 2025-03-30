<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Students";

    protected $primaryKey = 'student_id';
    protected $fillable = ['xp_points', 'cv_path', 'status_id', 'user_id'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'student_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Offer::class, 'wishlists', 'student_id', 'offer_id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'wishlist_offers', 'wishlist_id', 'offer_id');
    }

    public function skills()
    {
        return $this->hasMany(StudentSkill::class, 'student_id');
    }

    public function interns()
    {
        return $this->hasMany(Intern::class, 'student_id');
    }
}
