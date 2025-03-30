<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "Status";

    protected $primaryKey = 'status_id';
    protected $fillable = ['status_name'];

    public function applications()
    {
        return $this->hasMany(Application::class, 'status_id');
    }
}
