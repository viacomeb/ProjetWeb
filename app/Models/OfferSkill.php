<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferSkill extends Model
{
    use HasFactory;

    protected $table = 'OfferSkills';

    protected $fillable = [
        'offer_id',
        'skill_id',
    ];

    public $incrementing = false; // Composite primary key
    protected $keyType = 'string';

    // Relations
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
