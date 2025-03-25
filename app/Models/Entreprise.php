<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $table = 'entreprises';
    protected $fillable = ['nom', 'adresse', 'telephone', 'email', 'logo'];
}