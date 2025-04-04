<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function list()
    {
        $skills = Skill::all();
        return response()->json($skills);
    }
}
