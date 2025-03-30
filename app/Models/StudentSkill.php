<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSkill extends Model
{
    use HasFactory;

    protected $table = 'StudentSkills';

    protected $fillable = [
        'skill_id',
        'student_id',
    ];

    public $incrementing = false; // Composite primary key
    protected $keyType = 'string';

    // Relations
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
