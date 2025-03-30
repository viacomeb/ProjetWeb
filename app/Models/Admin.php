<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Admins";

    protected $primaryKey = 'admin_id';
    protected $fillable = ['user_id'];
}
