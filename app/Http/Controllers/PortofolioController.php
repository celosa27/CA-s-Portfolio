<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;

class PortofolioController extends Controller
{
    public function index()
    {
    $profile = Profile::first();
    $skills = Skill::all(); // ← ganti ini, hapus groupBy
    $projects = Project::where('is_featured', true)->get();
    return view('portofolio', compact('profile', 'skills', 'projects'));
    }

    public function projectDetail($id)
    {
    $project = \App\Models\Project::with('images')->findOrFail($id);
    return view('project-detail', compact('project'));
    }
}
