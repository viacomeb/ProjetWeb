<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $table = 'entreprises';

    protected $primaryKey = 'Id_Entreprise';

    protected $fillable = [
        'nom',
        'description',
        'telephone',
        'candidatures',
        'email',
    ];

    public function offres()
    {
        return $this->hasMany(Offre::class, 'Id_Entreprise');
    }
}
