<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
        .font-script { font-family: 'Caveat', cursive; }
    </style>
</head>
<body class="bg-white min-h-screen">

    <div class="flex items-center justify-between px-10 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Admin Panel</span>
        <span>{{ auth()->user()->name }}</span>
    </div>

    <nav class="flex items-center justify-between px-10 py-4 border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display text-2xl tracking-widest">ADMIN</span>
            <span class="text-blue-900 text-xl">✳</span>
        </div>
        <div class="flex items-center gap-6">
            <a href="/" class="text-gray-400 hover:text-gray-900 text-xs tracking-widest uppercase transition-colors">← Portfolio</a>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="bg-blue-900 text-white text-xs tracking-widest uppercase px-5 py-2 hover:bg-blue-800 transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-10 py-16">
        <h1 class="font-display text-7xl text-gray-900 leading-none mb-2">DASHBOARD</h1>
        <span class="font-script text-3xl text-blue-900 block mb-12">Welcome back, {{ auth()->user()->name }}</span>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="/admin/profile/edit"
               class="border border-gray-100 p-8 hover:border-blue-900 transition-all group block">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-3xl">👤</span>
                    <span class="text-blue-900/20 group-hover:text-blue-900/60 text-2xl transition-colors">✳</span>
                </div>
                <h3 class="font-display text-3xl text-gray-900 mb-2">PROFILE</h3>
                <span class="font-script text-lg text-blue-900 block mb-3">Edit info</span>
                <p class="text-gray-400 text-xs">Bio, photo & links</p>
            </a>

            <a href="/admin/skills"
               class="border border-gray-100 p-8 hover:border-blue-900 transition-all group block bg-blue-900">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-3xl">💡</span>
                    <span class="text-white/20 group-hover:text-white/60 text-2xl transition-colors">✳</span>
                </div>
                <h3 class="font-display text-3xl text-white mb-2">SKILLS</h3>
                <span class="font-script text-lg text-blue-200 block mb-3">Manage</span>
                <p class="text-blue-200/60 text-xs">Your skill set</p>
            </a>

            <a href="/admin/projects"
               class="border border-gray-100 p-8 hover:border-blue-900 transition-all group block">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-3xl">🗂️</span>
                    <span class="text-blue-900/20 group-hover:text-blue-900/60 text-2xl transition-colors">✳</span>
                </div>
                <h3 class="font-display text-3xl text-gray-900 mb-2">PROJECTS</h3>
                <span class="font-script text-lg text-blue-900 block mb-3">Manage</span>
                <p class="text-gray-400 text-xs">Add or remove</p>
            </a>
        </div>
    </div>
</body>
</html>