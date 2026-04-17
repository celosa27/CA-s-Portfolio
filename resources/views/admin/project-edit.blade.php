<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        input, textarea, select { outline: none; }
        input:focus, textarea:focus, select:focus { border-color: #1e3a8a !important; }
    </style>
</head>
<body class="bg-white min-h-screen">
    <div class="flex items-center justify-between px-10 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Admin Panel</span><span>Edit Project</span>
    </div>
    <nav class="flex items-center justify-between px-10 py-4 border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span style="font-family:'Bebas Neue',sans-serif" class="text-2xl tracking-widest">ADMIN</span>
            <span class="text-blue-900 text-xl">✳</span>
        </div>
        <a href="/admin/projects" class="text-gray-400 hover:text-gray-900 text-xs tracking-widest uppercase transition-colors">← Projects</a>
    </nav>

    <div class="max-w-3xl mx-auto px-10 py-16">
        <h1 style="font-family:'Bebas Neue',sans-serif" class="text-6xl text-gray-900 leading-none mb-2">EDIT PROJECT</h1>
        <span style="font-family:'Caveat',cursive" class="text-2xl text-blue-900 block mb-10">{{ $project->title }}</span>

        @if(session('success'))
            <div class="mb-8 px-5 py-4 border-l-4 border-blue-900 bg-blue-50 text-sm text-blue-900">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- Form edit info --}}
        <form method="POST" action="/admin/projects/{{ $project->id }}/update" enctype="multipart/form-data" class="space-y-5 mb-12 pb-12 border-b border-gray-100">
            @csrf
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Judul</label>
                <input type="text" name="title" value="{{ $project->title }}"
                       class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm resize-none">{{ $project->description }}</textarea>
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Tech Stack</label>
                <input type="text" name="tech_stack" value="{{ $project->tech_stack }}"
                       class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">GitHub URL</label>
                    <input type="text" name="github_url" value="{{ $project->github_url }}"
                           class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
                </div>
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Demo URL</label>
                    <input type="text" name="demo_url" value="{{ $project->demo_url }}"
                           class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
                </div>
            </div>

            {{-- Type & Role --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Tipe Project</label>
                    <select name="type" class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm bg-white">
                        <option value="individual" {{ $project->type === 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="team" {{ $project->type === 'team' ? 'selected' : '' }}>Team</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Role kamu (kalau team)</label>
                    <input type="text" name="role" value="{{ $project->role }}" placeholder="e.g. Frontend Developer"
                           class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Ganti Cover Image</label>
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}"
                         class="w-32 h-20 object-cover mb-3 border border-gray-100">
                @endif
                <input type="file" name="cover" accept="image/*" class="text-gray-400 text-sm">
            </div>

            <button type="submit"
                    class="w-full py-4 bg-blue-900 text-white text-xs tracking-widest uppercase hover:bg-blue-800 transition-colors">
                Save Changes
            </button>
        </form>

        {{-- Upload gallery images --}}
        <h2 style="font-family:'Bebas Neue',sans-serif" class="text-4xl text-gray-900 mb-6">GALLERY IMAGES</h2>

        <form method="POST" action="/admin/projects/{{ $project->id }}/images" enctype="multipart/form-data" class="border border-gray-100 p-6 mb-8">
            @csrf
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-3">Upload Gambar (bisa multiple)</label>
            <input type="file" name="images[]" accept="image/*" multiple class="text-gray-400 text-sm mb-4 block">
            <button type="submit"
                    class="px-6 py-3 bg-blue-900 text-white text-xs tracking-widest uppercase hover:bg-blue-800 transition-colors">
                Upload
            </button>
        </form>

        {{-- Daftar gambar --}}
        @if($project->images->count() > 0)
            <div class="grid grid-cols-3 gap-3">
                @foreach($project->images as $img)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $img->image) }}"
                             class="w-full aspect-square object-cover border border-gray-100">
                        <form method="POST" action="/admin/projects/images/{{ $img->id }}"
                              class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                              style="background:rgba(0,0,0,0.5)">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-white text-xs tracking-widest uppercase border border-white/50 px-3 py-2 hover:bg-white hover:text-gray-900 transition-colors">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-300 text-xs tracking-widest uppercase">Belum ada gambar gallery.</p>
        @endif

        {{-- Link ke detail page --}}
        <div class="mt-10 pt-8 border-t border-gray-100">
            <a href="/projects/{{ $project->id }}" target="_blank"
               class="text-xs tracking-widest uppercase text-blue-900 hover:underline">
                Preview Detail Page →
            </a>
        </div>
    </div>
</body>
</html>