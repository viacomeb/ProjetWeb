<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Companies";

    protected $primaryKey = 'company_id';
    protected $fillable = ['company_name', 'description', 'phone', 'email', 'street', 'street_number', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'company_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'company_id');
    }
}
