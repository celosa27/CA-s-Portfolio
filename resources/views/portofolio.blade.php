<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Portfolio' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
        .font-script { font-family: 'Caveat', cursive; }
        html { scroll-behavior: smooth; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.8s ease forwards; }
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.25s; opacity: 0; }
        .delay-3 { animation-delay: 0.4s; opacity: 0; }
        .delay-4 { animation-delay: 0.55s; opacity: 0; }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin-slow { animation: spin-slow 12s linear infinite; display: inline-block; }

        @keyframes ticker {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .ticker { animation: ticker 25s linear infinite; }
        .ticker:hover { animation-play-state: paused; }

        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute; bottom: -2px; left: 0;
            width: 0; height: 2px; background: #1e3a8a;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        .skill-bar { transition: width 1.8s cubic-bezier(0.4, 0, 0.2, 1); }

        .project-card { transition: all 0.3s ease; }
        .project-card:hover { transform: translateY(-4px); box-shadow: 0 20px 60px rgba(30,58,138,0.12); }
        .project-card img { transition: all 0.7s ease; filter: grayscale(40%); }
        .project-card:hover img { filter: grayscale(0%); }

        .grain {
            position: fixed; inset: 0; pointer-events: none; z-index: 99; opacity: 0.025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden">
<div class="grain"></div>

{{-- bar navigasi --}}
<nav class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-10 py-4 bg-white/90 backdrop-blur-sm border-b border-gray-100">
    <div class="flex items-center gap-2">
        <span class="font-display text-2xl tracking-widest text-gray-900">
            {{ strtoupper(explode(' ', $profile->name ?? 'Portfolio')[0]) }}
        </span>
        <span class="text-blue-900 text-xl spin-slow">✳</span>
    </div>
    <div class="flex items-center gap-8 text-xs font-medium tracking-widest uppercase text-gray-400">
        <a href="#home" class="nav-link hover:text-gray-900 transition-colors">Home</a>
        <a href="#about" class="nav-link hover:text-gray-900 transition-colors">About</a>
        <a href="#skills" class="nav-link hover:text-gray-900 transition-colors">Skills</a>
        <a href="#projects" class="nav-link hover:text-gray-900 transition-colors">Projects</a>
        <a href="#contact" class="nav-link hover:text-gray-900 transition-colors">Contact</a>
    </div>
</nav>

{{-- home --}}
<section id="home" class="min-h-screen pt-20 relative overflow-hidden bg-white flex flex-col">
    <div class="flex items-center justify-between px-10 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Portfolio</span>
        <span>{{ $profile->name ?? '' }}</span>
    </div>

    <div class="flex-1 flex items-center px-10 md:px-16 py-16">
        <div class="max-w-6xl mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            {{-- teks diletakkan di kiri --}}
            <div class="fade-up delay-1">
                <h1 class="font-display leading-none text-gray-900 mb-4"
                    style="font-size: clamp(2.8rem, 6vw, 5.5rem)">
                    HI, I'M<br>
                    <span style="color:#1e3a8a">{{ strtoupper($profile->name ?? 'YOUR NAME') }}</span>
                </h1>
                <p class="font-display text-2xl md:text-3xl text-gray-400 leading-tight mb-6">
                    {{ strtoupper($profile->tagline ?? '') }}
                </p>

                {{-- tag untuk skill --}}
                <div class="flex flex-wrap gap-3 mb-8">
                    @foreach($skills as $skill)
                        <span class="flex items-center gap-1 text-xs tracking-widest uppercase text-gray-500 font-medium">
                            <span style="color:#1e3a8a">✳</span> {{ $skill->name }}
                        </span>
                    @endforeach
                </div>

                <div class="flex gap-4">
                    <a href="#projects"
                       class="bg-gray-900 text-white text-xs tracking-widest uppercase px-6 py-3 hover:bg-blue-900 transition-colors">
                        Got a project?
                    </a>
                    <a href="#contact"
                       class="border border-gray-300 text-gray-600 text-xs tracking-widest uppercase px-6 py-3 hover:border-blue-900 hover:text-blue-900 transition-colors">
                        Let's talk.
                    </a>
                </div>
            </div>

            {{-- foto circle di bagian kanan --}}
            <div class="flex justify-center items-center relative fade-up delay-2">
                <span class="absolute font-display select-none pointer-events-none spin-slow"
                      style="font-size:20rem; color:#1e3a8a; opacity:0.05; line-height:1">✳</span>
                <span class="absolute spin-slow select-none pointer-events-none"
                      style="font-size:14rem; color:#3b82f6; opacity:0.05; line-height:1; animation-duration:8s">✳</span>
                <span class="absolute spin-slow select-none pointer-events-none"
                      style="font-size:8rem; color:#93c5fd; opacity:0.08; line-height:1; animation-duration:5s">✳</span>

                <div class="relative z-10 w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden border-4 border-white shadow-2xl">
                    @if($profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}"
                             class="w-full h-full object-cover object-top"
                             style="filter: grayscale(20%)">
                    @else
                        <div class="w-full h-full bg-blue-50 flex items-center justify-center">
                            <span class="font-display text-6xl text-blue-200">
                                {{ substr($profile->name ?? 'P', 0, 1) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Ticker biru  untuk About --}}
    <div class="overflow-hidden py-3 border-t border-blue-800" style="background:#1e3a8a">
        <div class="ticker flex whitespace-nowrap">
            @for($i = 0; $i < 2; $i++)
                <div class="flex items-center gap-8 pr-8">
                    @foreach(['About Me', 'Who I Am', 'Background', 'Experience', 'Introduction', 'Get To Know Me'] as $item)
                        <span class="text-xs tracking-widest uppercase text-white/70 font-medium">{{ $item }}</span>
                        <span class="text-white/30 spin-slow" style="animation-duration:6s">✳</span>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</section>

{{-- About Me --}}
<section id="about" class="relative overflow-hidden">
    <div class="flex items-center justify-between px-10 py-3 border-b border-t border-gray-100 text-xs tracking-widest uppercase text-gray-300 bg-white">
        <span>About Me</span>
        <span>Introduction</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 min-h-screen">
        <div class="bg-white px-10 py-16 flex flex-col justify-center border-r border-gray-100">
            <h2 class="font-display text-6xl md:text-8xl leading-none text-gray-900 mb-2">
                ABOUT ME <span class="text-blue-900 spin-slow" style="display:inline-block">✳</span>
            </h2>
            <span class="font-script text-3xl text-blue-900 mb-8">Introduction</span>
            <p class="text-gray-500 leading-relaxed text-sm max-w-sm mb-10">{{ $profile->bio ?? '' }}</p>
            <div class="flex gap-4">
                @if($profile->email)
                    <a href="mailto:{{ $profile->email }}"
                       class="bg-blue-900 text-white text-xs tracking-widest uppercase px-6 py-3 hover:bg-blue-800 transition-colors">
                        Email Me →
                    </a>
                @endif
                @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank"
                       class="border border-gray-200 text-gray-600 text-xs tracking-widest uppercase px-6 py-3 hover:border-blue-900 hover:text-blue-900 transition-colors">
                        GitHub
                    </a>
                @endif
            </div>
        </div>

        <div class="relative overflow-hidden bg-gray-50 flex items-end min-h-96">
            @if($profile->photo)
                <img src="{{ asset('storage/' . $profile->photo) }}"
                     class="w-full h-full object-cover object-top absolute inset-0"
                     style="filter: grayscale(30%)">
                <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(255,255,255,0.4), transparent)"></div>
            @endif
            <div class="relative z-10 p-8">
                <span class="font-script text-5xl text-white drop-shadow-lg">{{ explode(' ', $profile->name ?? '')[0] ?? '' }}</span>
            </div>
        </div>
    </div>

{{-- skills --}}
<section id="skills" class="relative overflow-hidden bg-blue-900">
    <div class="flex items-center justify-between px-10 py-3 border-b border-blue-800 text-xs tracking-widest uppercase text-blue-400">
        <span>Strengths</span>
        <span>Expertise</span>
    </div>

    <div class="px-10 py-16">
        <div class="flex items-start gap-4 mb-12">
            <h2 class="font-display text-6xl md:text-8xl leading-none text-white">SKILLS</h2>
            <span class="text-white/20 text-4xl mt-2 spin-slow" style="display:inline-block">✳</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($skills as $skill)
                <div class="border border-blue-800 p-6 hover:border-white/40 transition-colors">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-white font-medium tracking-wide text-sm uppercase">{{ $skill->name }}</span>
                        <span class="font-display text-3xl text-white/40">{{ $skill->level }}%</span>
                    </div>
                    <div class="w-full h-px bg-blue-800 relative overflow-hidden">
                        <div class="skill-bar h-px bg-white absolute top-0 left-0"
                             style="width: {{ $skill->level }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

{{-- my projects --}}
<section id="projects" class="relative overflow-hidden bg-white">
    <div class="flex items-center justify-between px-10 py-3 border-b border-t border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Selected Work</span>
        <span>Projects</span>
    </div>

    <div class="px-10 py-16">
        <div class="flex items-start gap-4 mb-12">
            <h2 class="font-display text-6xl md:text-8xl leading-none text-gray-900">PROJECTS</h2>
            <span class="text-blue-900/20 text-4xl mt-2 spin-slow" style="display:inline-block">✳</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($projects as $project)
                <div class="project-card border border-gray-100">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100 text-xs tracking-widest uppercase text-gray-300">
                        <span>{{ $project->tech_stack }}</span>
                        <span class="text-blue-900 spin-slow" style="display:inline-block">✳</span>
                    </div>

                    @if($project->image)
                        <div class="overflow-hidden h-56">
                            <img src="{{ asset('storage/' . $project->image) }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-56 flex items-center justify-center bg-gray-50">
                            <span class="font-display text-8xl text-gray-100">✳</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <a href="/projects/{{ $project->id }}">
                            <h3 class="font-display text-4xl text-gray-900 mb-1 hover:text-blue-900 transition-colors cursor-pointer">
                                {{ strtoupper($project->title) }}
                            </h3>
                        </a>
                        <span class="font-script text-xl text-blue-900 block mb-4">
                            {{ $project->type === 'team' ? 'Team Project' : 'Individual' }}
                        </span>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">{{ $project->description }}</p>
                        <div class="flex gap-4">
                            <a href="/projects/{{ $project->id }}"
                               class="text-xs tracking-widest uppercase bg-blue-900 text-white px-4 py-2 hover:bg-blue-800 transition-colors">
                                View Detail →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

{{-- contact me --}}
<section id="contact" class="relative overflow-hidden bg-gray-50">
    <div class="flex items-center justify-between px-10 py-3 border-b border-t border-gray-100 text-xs tracking-widest uppercase text-gray-300">
        <span>Get In Touch</span>
        <span>Contact</span>
    </div>

    <div class="px-10 py-24 relative">
        <span class="absolute right-10 top-16 font-display text-[12rem] leading-none text-gray-100 select-none pointer-events-none spin-slow" style="display:inline-block">✳</span>

        <div class="max-w-2xl relative z-10">
            <h2 class="font-display text-6xl md:text-8xl leading-none text-gray-900 mb-2">LET'S WORK</h2>
            <div class="flex items-center gap-4 mb-12">
                <h2 class="font-display text-6xl md:text-8xl leading-none text-blue-900">TOGETHER</h2>
                <span class="font-script text-4xl text-blue-900">✳</span>
            </div>

            <div class="flex gap-8">
                @if($profile->email)
                    <a href="mailto:{{ $profile->email }}"
                       class="group flex flex-col items-center gap-3">
                        <div class="w-14 h-14 border border-gray-200 group-hover:border-blue-900 group-hover:bg-blue-900 flex items-center justify-center transition-all">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs tracking-widest uppercase text-gray-300 group-hover:text-blue-900 transition-colors">Email</span>
                    </a>
                @endif

                @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank"
                       class="group flex flex-col items-center gap-3">
                        <div class="w-14 h-14 border border-gray-200 group-hover:border-blue-900 group-hover:bg-blue-900 flex items-center justify-center transition-all">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                        </div>
                        <span class="text-xs tracking-widest uppercase text-gray-300 group-hover:text-blue-900 transition-colors">GitHub</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

{{-- footer --}}
<footer class="bg-white border-t border-gray-100 py-5 px-10 flex items-center justify-between">
    <span class="font-display text-xl text-gray-200 tracking-widest">{{ strtoupper($profile->name ?? '') }}</span>
    <a href="/admin" class="text-gray-200 hover:text-blue-900 text-xs tracking-widest uppercase transition-colors">Admin</a>
</footer>

</body>
</html>