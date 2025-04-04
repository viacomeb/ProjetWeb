<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Offers";

    protected $primaryKey = 'offer_id';
    protected $fillable = ['title', 'description', 'salary', 'start_date', 'end_date', 'is_active', 'view_count', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'offer_skills', 'offer_id', 'skill_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'offer_id');
    }

    public function offerSkills()
    {
        return $this->hasMany(OfferSkill::class, 'offer_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'offer_id');
    }

    public function interns()
    {
        return $this->hasMany(Intern::class, 'offer_id');
    }
}
