<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
        .font-script { font-family: 'Caveat', cursive; }
        input, textarea { outline: none; }
        input:focus, textarea:focus { border-color: #1e3a8a !important; }
    </style>
</head>
<body class="bg-white min-h-screen">
    <div class="flex items-center justify-between px-10 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Admin Panel</span><span>Projects</span>
    </div>
    <nav class="flex items-center justify-between px-10 py-4 border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display text-2xl tracking-widest">ADMIN</span>
            <span class="text-blue-900 text-xl">✳</span>
        </div>
        <a href="/admin" class="text-gray-400 hover:text-gray-900 text-xs tracking-widest uppercase transition-colors">← Dashboard</a>
    </nav>

    <div class="max-w-3xl mx-auto px-10 py-16">
        <h1 class="font-display text-7xl text-gray-900 leading-none mb-2">PROJECTS</h1>
        <span class="font-script text-3xl text-blue-900 block mb-12">Manage your work</span>

        @if(session('success'))
            <div class="mb-8 px-5 py-4 border-l-4 border-blue-900 bg-blue-50 text-sm text-blue-900">
                ✓ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/admin/projects/store" enctype="multipart/form-data"
      class="border border-gray-100 p-6 mb-12 space-y-4">
    @csrf
    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Tambah Project Baru</label>
    
    <input type="text" name="title" placeholder="Judul project..."
           class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
    
    <textarea name="description" rows="3" placeholder="Deskripsi..."
              class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm resize-none"></textarea>
    
    <input type="text" name="tech_stack" placeholder="Tech stack (Laravel, MySQL, dll)"
           class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
    
    <div class="grid grid-cols-2 gap-4">
        <input type="text" name="github_url" placeholder="GitHub URL"
               class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
        <input type="text" name="demo_url" placeholder="Demo URL (opsional)"
               class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
    </div>

    {{-- Tipe project & role --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Tipe Project</label>
            <select name="type" class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm bg-white"
                    onchange="document.getElementById('role-field').style.display = this.value === 'team' ? 'block' : 'none'">
                <option value="individual">👤 Individual</option>
                <option value="team">👥 Team</option>
            </select>
        </div>
        <div id="role-field" style="display:none">
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Role Kamu</label>
            <input type="text" name="role" placeholder="e.g. Frontend Developer"
                   class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
        </div>
    </div>

    {{-- Cover image --}}
    <div>
        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Cover Image</label>
        <input type="file" name="image" accept="image/*" class="text-gray-400 text-sm">
    </div>

    {{-- Multiple gallery images --}}
    <div>
        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Gallery Images (bisa pilih banyak)</label>
        <input type="file" name="gallery[]" accept="image/*" multiple class="text-gray-400 text-sm">
        <p class="text-xs text-gray-300 mt-1">Tahan Ctrl/Cmd untuk pilih lebih dari 1 foto</p>
    </div>

    <button type="submit"
            class="w-full py-4 bg-blue-900 text-white text-xs tracking-widest uppercase hover:bg-blue-800 transition-colors">
        Add Project
    </button>
</form>

        <div class="space-y-3">
            @foreach($projects as $project)
                <div class="flex items-center gap-5 border border-gray-100 hover:border-blue-900/20 transition-colors p-4">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}"
                             class="w-20 h-16 object-cover flex-shrink-0" style="filter:grayscale(30%)">
                    @else
                        <div class="w-20 h-16 flex-shrink-0 flex items-center justify-center bg-gray-50">
                            <span class="text-gray-200 text-2xl">✳</span>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="font-display text-2xl text-gray-900">{{ strtoupper($project->title) }}</h3>
                        <a href="/admin/projects/{{ $project->id }}/edit" class="text-xs tracking-widest uppercase text-blue-900 hover:underline mr-4"> Edit </a>
                        <p class="text-xs text-blue-900/40 tracking-wide uppercase mt-1">{{ $project->tech_stack }}</p>
                    </div>
                    <form method="POST" action="/admin/projects/{{ $project->id }}" class="flex-shrink-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-xs tracking-widest uppercase text-gray-300 hover:text-red-400 transition-colors">
                            Remove
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>