<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $table = 'offres';

    protected $primaryKey = 'Id_Offre';

    protected $fillable = [
        'titre',
        'description',
        'competence',
        'remuneration',
        'concurrents',
        'dates',
        'Id_Entreprise',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'Id_Entreprise');
    }
}
