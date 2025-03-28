<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Skills";

    protected $primaryKey = 'skill_id';
    protected $fillable = ['name'];

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_skills', 'skill_id', 'offer_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_skills', 'skill_id', 'student_id');
    }
}
