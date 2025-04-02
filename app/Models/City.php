<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Cities";

    protected $primaryKey = 'city_id';
    protected $fillable = ['city_name', 'postal_code', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'city_id');
    }

    public function country()
    {
        return $this->hasOneThrough(Country::class, Department::class, 'department_id', 'country_id', 'department_id', 'country_id');
    }
}
