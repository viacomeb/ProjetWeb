<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $table = 'offres';
    protected $fillable = ['titre', 'description', 'date_debut', 'date_fin', 'entreprise_id'];

    public function entreprise()
    {
        return $this->belongsTo('App\Models\Entreprise');
    }
}