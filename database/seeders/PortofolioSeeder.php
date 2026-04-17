<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;

class PortofolioSeeder extends Seeder
{
    public function run(): void {
    Profile::create([
        'name' => 'Chelsea Athalia',
        'tagline' => 'Aspiring Full-Stack Developer',
        'bio' => 'Hi! I am a Computer Science student with a strong interest in full-stack development. I enjoy turning ideas into functional systems and have experience in data structures, system design, and basic web development.',
        'email' => 'chlsathalia@gmail.com',
        'github' => 'https://github.com/celosa27',
    ]);

    $skills = [
    ['name' => 'UI/UX', 'category' => 'Design', 'level' => 75],
    ['name' => 'Frontend', 'category' => 'Dev', 'level' => 60],
    ['name' => 'Database Dasar', 'category' => 'Dev', 'level' => 50],
];
    foreach ($skills as $skill){
        Skill::create($skill);
    }

    $projects = [
        [
            'title' => 'Perfume E-Commerce Website (FrontEnd)',
            'description' => 'Developed a product detail page for a perfume e-commerce website using HTML and CSS.
            The page displays product information such as image, description, price, and fragrance notes in a clear
            and visually appealing layout (This is a Team Project',
            'tech_stack' => 'HTML, CSS',
            'github_url' => 'https://github.com/celosa27/MidProject-BNCC-LnT-FrontendDevelopment-2025.git',
            'is_featured' => true,
        ]
    ];
    foreach ($projects as $project) {
            Project::create($project);
    }
}
}