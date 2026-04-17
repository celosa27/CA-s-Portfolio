<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'image',
        'tech_stack', 'github_url', 'demo_url',
        'is_featured', 'type', 'role'
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }
}