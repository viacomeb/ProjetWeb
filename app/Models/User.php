<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "Users";

    protected $primaryKey = 'user_id'; // Remplacez 'user_id' par le nom réel de votre clé primaire

    protected $fillable = ['password', 'last_name', 'first_name', 'email', 'street', 'street_number', 'city_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    // Relations vers les rôles
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function pilot()
    {
        return $this->hasOne(Pilot::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }
}
