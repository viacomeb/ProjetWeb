<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'Wishlists';

    protected $fillable = [
        'offer_id',
        'student_id',
    ];

    public $incrementing = false; // Composite primary key
    protected $keyType = 'string';

    // Relations
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
