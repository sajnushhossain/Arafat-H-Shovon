<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>About Myself - Arafat H Shovon</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body class="font-sans antialiased bg-secondary text-white min-h-screen flex flex-col">

    @include('layouts.guest-navigation')

    <main class="flex-grow py-12 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                
                <!-- Hero Section with Properly Shaped Image -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-24">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-primary/20 rounded-[3rem] blur-3xl group-hover:bg-primary/30 transition duration-700"></div>
                        <div class="relative rounded-[3rem] overflow-hidden shadow-2xl aspect-[4/5] border border-white/10">
                            <img src="{{ $settings['about_me_picture_url']->value ?? 'https://via.placeholder.com/1920x1080' }}" 
                                 alt="About Me" 
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        </div>
                    </div>
                    
                    <div class="space-y-8">
                        <div>
                            <span class="inline-block px-5 py-1.5 mb-6 text-xs font-bold tracking-[0.4em] uppercase bg-primary text-white rounded-sm">
                                My Story
                            </span>
                            <h1 class="text-5xl md:text-7xl font-black text-white leading-[0.9] tracking-tighter mb-8">
                                About <span class="text-primary">Myself.</span>
                            </h1>
                            <div class="prose prose-invert prose-lg max-w-none text-gray-200">
                                {{ $settings['about_me_text']->value ?? 'My name is Arafat H Shovon. I am a passionate photographer with a love for capturing the beauty of the world around me. I am flexible, reliable and possess excellent time keeping skills. I am an enthusiastic, self-motivated, responsible and hard-working person. I am a mature team worker and adaptable to all challenging situations.' }}
                            </div>
                        </div>

                        <!-- Skills Summary -->
                        <div class="grid grid-cols-2 gap-6 pt-8 border-t border-white/10">
                            <div>
                                <h3 class="text-primary font-black uppercase tracking-widest text-sm mb-2">Mastery</h3>
                                <p class="text-white font-bold">{{ $skills->count() }} Specialized Skills</p>
                            </div>
                            <div>
                                <h3 class="text-primary font-black uppercase tracking-widest text-sm mb-2">Experience</h3>
                                <p class="text-white font-bold">International Photographer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Educational Background Section -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 md:p-10 shadow-2xl">
                        <h2 class="text-3xl font-bold mb-8 text-primary flex items-center">
                            <i class="fas fa-graduation-cap mr-4"></i> Education
                        </h2>
                        <div class="space-y-8">
                            @forelse($education as $index => $item)
                                <div class="flex gap-6 group">
                                    <div class="flex-shrink-0 w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center text-primary font-bold border border-primary/30 group-hover:bg-primary group-hover:text-white transition duration-300">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-grow pb-6 border-b border-white/5 last:border-0">
                                        <span class="text-sm font-bold text-gray-400 tracking-wider uppercase">{{ $item->year }}</span>
                                        <h3 class="text-xl font-bold text-white mt-1">{{ $item->degree }}</h3>
                                        <p class="text-gray-400 font-medium mt-1">{{ $item->institution }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-400 italic text-center py-4">No educational background added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="space-y-8 lg:space-y-12">
                        <!-- Languages Section -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 md:p-10 shadow-2xl">
                            <h2 class="text-3xl font-bold mb-8 text-primary flex items-center">
                                <i class="fas fa-language mr-4"></i> Languages
                            </h2>
                            <div class="space-y-4">
                                @forelse($languages as $index => $item)
                                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/5 group hover:border-primary/30 transition duration-300">
                                        <div class="flex items-center gap-3">
                                            <span class="text-primary font-bold">{{ $index + 1 }}.</span>
                                            <span class="text-white font-bold">{{ $item->name }}</span>
                                        </div>
                                        <span class="text-gray-400 text-sm font-medium">{{ $item->level }}</span>
                                    </div>
                                @empty
                                    <p class="text-gray-400 italic text-center py-4">No languages added yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- References Section -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 md:p-10 shadow-2xl">
                            <h2 class="text-3xl font-bold mb-8 text-primary flex items-center">
                                <i class="fas fa-user-check mr-4"></i> References
                            </h2>
                            <div class="space-y-6">
                                @forelse($references as $index => $item)
                                    <div class="flex gap-6 p-6 bg-white/5 rounded-2xl border border-white/5 group hover:border-primary/30 transition duration-300">
                                        <div class="flex-shrink-0 w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center text-primary font-bold border border-primary/30">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold text-white">{{ $item->name }}</h4>
                                            <p class="text-gray-400 font-medium mt-1">{{ $item->position }}</p>
                                            <div class="flex items-center gap-2 mt-2 text-primary">
                                                <i class="fas fa-envelope-open text-xs"></i>
                                                <span class="text-sm font-bold tracking-wide">{{ $item->contact }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-400 italic text-center py-4">No references added yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-auto border-t border-white/5">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500 font-medium">&copy; {{ date('Y') }} Arafat H Shovon <span class="italic font-serif text-sm">International</span>. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>
