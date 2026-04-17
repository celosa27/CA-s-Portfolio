<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        <span>Admin Panel</span><span>Edit Profile</span>
    </div>
    <nav class="flex items-center justify-between px-10 py-4 border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display text-2xl tracking-widest">ADMIN</span>
            <span class="text-blue-900 text-xl">✳</span>
        </div>
        <a href="/admin" class="text-gray-400 hover:text-gray-900 text-xs tracking-widest uppercase transition-colors">← Dashboard</a>
    </nav>

    <div class="max-w-2xl mx-auto px-10 py-16">
        <h1 class="font-display text-7xl text-gray-900 leading-none mb-2">PROFILE</h1>
        <span class="font-script text-3xl text-blue-900 block mb-12">Edit your info</span>

        @if(session('success'))
            <div class="mb-8 px-5 py-4 border-l-4 border-blue-900 bg-blue-50 text-sm text-blue-900">
                ✓ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/admin/profile/update" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @foreach([['name','Nama','text'],['tagline','Tagline','text'],['email','Email','email'],['github','GitHub URL','text']] as $f)
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">{{ $f[1] }}</label>
                <input type="{{ $f[2] }}" name="{{ $f[0] }}" value="{{ $profile->{$f[0]} }}"
                       class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm transition-colors">
            </div>
            @endforeach

            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Bio</label>
                <textarea name="bio" rows="5"
                          class="w-full border border-gray-200 px-4 py-3 text-gray-700 text-sm transition-colors resize-none">{{ $profile->bio }}</textarea>
            </div>

            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-3">Foto Profile</label>
                @if($profile->photo)
                    <img src="{{ asset('storage/' . $profile->photo) }}"
                         class="w-20 h-20 object-cover mb-3 border border-gray-100" style="filter:grayscale(30%)">
                @endif
                <input type="file" name="photo" accept="image/*" class="text-gray-400 text-sm">
            </div>

            <button type="submit"
                    class="w-full py-4 bg-blue-900 text-white text-xs tracking-widest uppercase font-medium hover:bg-blue-800 transition-colors">
                Save Changes
            </button>
        </form>
    </div>
</body>
</html>