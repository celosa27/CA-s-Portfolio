<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Skills</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
        .font-script { font-family: 'Caveat', cursive; }
        input { outline: none; }
        input:focus { border-color: #1e3a8a !important; }
    </style>
</head>
<body class="bg-white min-h-screen">
    <div class="flex items-center justify-between px-10 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Admin Panel</span><span>Skills</span>
    </div>
    <nav class="flex items-center justify-between px-10 py-4 border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display text-2xl tracking-widest">ADMIN</span>
            <span class="text-blue-900 text-xl">✳</span>
        </div>
        <a href="/admin" class="text-gray-400 hover:text-gray-900 text-xs tracking-widest uppercase transition-colors">← Dashboard</a>
    </nav>

    <div class="max-w-2xl mx-auto px-10 py-16">
        <h1 class="font-display text-7xl text-gray-900 leading-none mb-2">SKILLS</h1>
        <span class="font-script text-3xl text-blue-900 block mb-12">Manage your expertise</span>

        @if(session('success'))
            <div class="mb-8 px-5 py-4 border-l-4 border-blue-900 bg-blue-50 text-sm text-blue-900">
                ✓ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/admin/skills/store" class="border border-gray-100 p-6 mb-8">
            @csrf
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-4">Tambah Skill Baru</label>
            <div class="flex gap-3">
                <input type="text" name="name" placeholder="Nama skill..."
                       class="flex-1 border border-gray-200 px-4 py-3 text-gray-700 text-sm transition-colors">
                <input type="number" name="level" placeholder="%" min="1" max="100"
                       class="w-24 border border-gray-200 px-4 py-3 text-gray-700 text-sm transition-colors text-center">
                <button type="submit"
                        class="px-6 py-3 bg-blue-900 text-white text-xs tracking-widest uppercase hover:bg-blue-800 transition-colors">
                    Add
                </button>
            </div>
        </form>

        <div class="space-y-2">
            @foreach($skills as $skill)
                <div class="flex items-center justify-between px-6 py-4 border border-gray-100 hover:border-blue-900/20 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-gray-700 font-medium text-sm uppercase tracking-wide">{{ $skill->name }}</span>
                        <span class="font-display text-2xl text-blue-900/40">{{ $skill->level }}%</span>
                    </div>
                    <form method="POST" action="/admin/skills/{{ $skill->id }}">
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