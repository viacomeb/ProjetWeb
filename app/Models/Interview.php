<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Interviews";

    protected $primaryKey = null; // Composite key
    public $incrementing = false;
    protected $fillable = ['offer_id', 'student_id', 'interview_date'];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
