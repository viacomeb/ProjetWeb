<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Applications";

    protected $primaryKey = 'application_id';
    protected $fillable = ['cover_letter_path', 'application_date', 'offer_id', 'student_id', 'status_id'];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
