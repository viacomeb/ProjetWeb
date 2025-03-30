<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends User
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Pilots";

    protected $primaryKey = 'pilot_id';
    protected $fillable = ['user_id'];
}
