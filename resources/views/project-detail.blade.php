<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} — Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
        .font-script { font-family: 'Caveat', cursive; }
        html { scroll-behavior: smooth; }

        @keyframes ticker {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .ticker { animation: ticker 20s linear infinite; }

        .gallery-img {
            transition: all 0.3s ease;
            filter: grayscale(30%);
        }
        .gallery-img:hover {
            filter: grayscale(0%);
            transform: scale(1.02);
        }

        .lightbox { display: none; }
        .lightbox.active { display: flex; }
    </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden">

{{-- navigation bar --}}
<nav class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-10 py-4 bg-white/90 backdrop-blur-sm border-b border-gray-100">
    <div class="flex items-center gap-2">
        <a href="/" class="font-display text-2xl tracking-widest text-gray-900">CHELSEA</a>
        <span class="text-blue-900 text-xl">✳</span>
    </div>
    <a href="/#projects" class="text-gray-400 hover:text-gray-900 text-xs tracking-widest uppercase transition-colors">← Back to Projects</a>
</nav>

{{-- halaman projects --}}
<section class="pt-20 bg-white">
    <div class="flex items-center justify-between px-10 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Selected Work</span>
        <span>Project Detail</span>
    </div>
    <div class="px-10 md:px-16 py-16 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
            {{-- Cover image --}}
            <div>
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}"
                         class="w-full aspect-video object-cover" style="filter:grayscale(20%)">
                @else
                    <div class="w-full aspect-video bg-gray-50 flex items-center justify-center">
                        <span class="font-display text-8xl text-gray-100">✳</span>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div>
                <p class="text-xs tracking-widest uppercase text-blue-900/50 mb-3">{{ $project->tech_stack }}</p>
                <h1 class="font-display text-6xl md:text-7xl leading-none text-gray-900 mb-4">
                    {{ strtoupper($project->title) }}
                </h1>
                <span class="font-script text-2xl text-blue-900 block mb-8">Project</span>

                {{-- tipe project (individu/tim) --}}
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-xs tracking-widest uppercase px-4 py-2 border font-medium
                        {{ $project->type === 'team' ? 'border-blue-900 text-blue-900 bg-blue-50' : 'border-gray-200 text-gray-500' }}">
                        {{ $project->type === 'team' ? '👥 Team Project' : '👤 Individual' }}
                    </span>
                    @if($project->type === 'team' && $project->role)
                        <span class="text-xs tracking-widest uppercase px-4 py-2 bg-blue-900 text-white">
                            Role: {{ $project->role }}
                        </span>
                    @endif
                </div>

                <p class="text-gray-500 leading-relaxed text-sm mb-8">{{ $project->description }}</p>

                <div class="flex gap-4">
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank"
                           class="border border-gray-200 text-gray-600 text-xs tracking-widest uppercase px-5 py-3 hover:border-blue-900 hover:text-blue-900 transition-colors">
                            GitHub →
                        </a>
                    @endif
                    @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank"
                           class="bg-blue-900 text-white text-xs tracking-widest uppercase px-5 py-3 hover:bg-blue-800 transition-colors">
                            Live Demo
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Galeri Foto project --}}
@if($project->images->count() > 0)
<section class="py-16 px-10 md:px-16 bg-white">
    <div class="max-w-6xl mx-auto">
        <h2 class="font-display text-5xl text-gray-900 mb-2">GALLERY</h2>
        <span class="font-script text-2xl text-blue-900 block mb-10">Project Images</span>

        <div class="columns-1 md:columns-2 lg:columns-3 gap-4 space-y-4">
            @foreach($project->images as $img)
                <div class="break-inside-avoid cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $img->image) }}')">
                    <img src="{{ asset('storage/' . $img->image) }}"
                         class="gallery-img w-full object-cover border border-gray-100">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- LIGHTBOX --}}
<div id="lightbox" class="lightbox fixed inset-0 z-50 bg-black/90 items-center justify-center"
     onclick="closeLightbox()">
    <img id="lightbox-img" src="" class="max-w-4xl max-h-screen object-contain p-4">
    <button onclick="closeLightbox()"
            class="absolute top-6 right-8 text-white/60 hover:text-white text-3xl font-light">✕</button>
</div>

{{-- footer --}}
<footer class="bg-white border-t border-gray-100 py-5 px-10 flex items-center justify-between">
    <span class="font-display text-xl text-gray-200 tracking-widest">CHELSEA ATHALIA</span>
    <a href="/" class="text-blue-900 text-xs tracking-widest uppercase hover:underline">← Back to Portfolio</a>
    <span class="text-gray-300 text-xs">© {{ date('Y') }}</span>
</footer>

<script>
    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

</body>
</html>