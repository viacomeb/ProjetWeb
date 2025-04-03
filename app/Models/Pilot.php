<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    use HasFactory;

    protected $table = 'Pilots';

    protected $primaryKey = 'pilot_id';
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getLastAdded()
    {
        $lastPilot = self::orderBy('pilot_id', 'desc')->first();
        return $lastPilot->user->first_name . ' ' . $lastPilot->user->last_name;
    }
}
