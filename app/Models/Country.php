<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Countries";

    protected $primaryKey = 'country_id';
    protected $fillable = ['country_name'];

    public function departments()
    {
        return $this->hasMany(Department::class, 'country_id');
    }
}
