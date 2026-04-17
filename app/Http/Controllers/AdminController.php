<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // Edit profile form
    public function editProfile()
    {
        $profile = Profile::first();
        return view('admin.profile', compact('profile'));
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $profile = Profile::first();

        $profile->update([
            'name' => $request->name,
            'tagline' => $request->tagline,
            'bio' => $request->bio,
            'email' => $request->email,
            'github' => $request->github,
        ]);

        // Upload foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $profile->update(['photo' => $path]);
        }

        return redirect('/admin/profile/edit')->with('success', 'Profile berhasil diupdate!');
    }

    // Halaman skills
    public function skills()
    {
        $skills = Skill::all();
        return view('admin.skills', compact('skills'));
    }

    // Tambah skill
    public function storeSkill(Request $request)
    {
        Skill::create(['name' => $request->name]);
        return redirect('/admin/skills')->with('success', 'Skill berhasil ditambahkan!');
    }

    // Hapus skill
    public function deleteSkill($id)
    {
        Skill::findOrFail($id)->delete();
        return redirect('/admin/skills')->with('success', 'Skill berhasil dihapus!');
    }

    // Halaman projects
    public function projects()
    {
        $projects = Project::all();
        return view('admin.projects', compact('projects'));
    }

    // Tambah project
    public function storeProject(Request $request)
{
    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'tech_stack' => $request->tech_stack,
        'github_url' => $request->github_url,
        'demo_url' => $request->demo_url,
        'type' => $request->type ?? 'individual',
        'role' => $request->role,
        'is_featured' => true,
    ];

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('projects', 'public');
        $data['image'] = $path;
    }

    $project = Project::create($data);

    // Upload gallery images sekaligus
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $index => $file) {
            $path = $file->store('projects', 'public');
            \App\Models\ProjectImage::create([
                'project_id' => $project->id,
                'image' => $path,
                'order' => $index,
            ]);
        }
    }

    return redirect('/admin/projects')->with('success', 'Project berhasil ditambahkan!');
}

    // Hapus project
    public function deleteProject($id)
    {
        Project::findOrFail($id)->delete();
        return redirect('/admin/projects')->with('success', 'Project berhasil dihapus!');
    }

    public function editProject($id)
{
    $project = \App\Models\Project::with('images')->findOrFail($id);
    return view('admin.project-edit', compact('project'));
}

public function updateProject(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);
    $project->update([
        'title' => $request->title,
        'description' => $request->description,
        'tech_stack' => $request->tech_stack,
        'github_url' => $request->github_url,
        'demo_url' => $request->demo_url,
        'type' => $request->type,
        'role' => $request->role,
    ]);

    if ($request->hasFile('cover')) {
        $path = $request->file('cover')->store('projects', 'public');
        $project->update(['image' => $path]);
    }

    return redirect("/admin/projects/{$id}/edit")->with('success', 'Project berhasil diupdate!');
}

public function uploadImages(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $file) {
            $path = $file->store('projects', 'public');
            \App\Models\ProjectImage::create([
                'project_id' => $project->id,
                'image' => $path,
                'order' => $project->images()->count() + $index,
            ]);
        }
    }
    return redirect("/admin/projects/{$id}/edit")->with('success', 'Gambar berhasil diupload!');
}

public function deleteImage($imageId)
{
    \App\Models\ProjectImage::findOrFail($imageId)->delete();
    return back()->with('success', 'Gambar berhasil dihapus!');
}
}
