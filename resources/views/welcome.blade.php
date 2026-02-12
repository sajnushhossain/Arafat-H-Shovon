<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>Arafat H Shovon - Photographer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .perspective {
            perspective: 1000px;
        }
        .card-flip {
            transition: transform 1s;
            transform-style: preserve-3d;
        }
        .card-container:hover .card-flip {
            transform: rotateY(180deg);
        }
        .front-face, .back-face {
            backface-visibility: hidden;
        }
        .back-face {
            transform: rotateY(180deg);
        }
    </style>
</head>

<body class="font-sans antialiased bg-secondary text-white">

    <!-- Navigation -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white sticky top-0 z-50 shadow-lg">
        <nav class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="/" class="text-2xl md:text-3xl font-bold transition duration-300 hover:text-gray-300">Arafat H Shovon</a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#about" class="hover:text-gray-300 transition duration-300">About</a>
                <a href="#achievements" class="hover:text-gray-300 transition duration-300">Achievements</a>
                <a href="#qualification" class="hover:text-gray-300 transition duration-300">Qualification</a>
                <a href="#team" class="hover:text-gray-300 transition duration-300">Team</a>
                <a href="#testimonials" class="hover:text-gray-300 transition duration-300">Testimonials</a>
                <a href="#contact" class="hover:text-gray-300 transition duration-300">Contact</a>
                <!-- <a href="{{ route('admin.login') }}"
                    class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] duration-300">Admin Login</a> -->
            </div>
            <button class="md:hidden flex items-center text-white focus:outline-none" id="mobile-menu-button" aria-expanded="false">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path id="top-bar" class="transition-all duration-300 ease-in-out" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16"></path>
                    <path id="middle-bar" class="transition-all duration-300 ease-in-out" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16"></path>
                    <path id="bottom-bar" class="transition-all duration-300 ease-in-out" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 18h16"></path>
                </svg>
            </button>
        </nav>
        <!-- Mobile Menu -->
        <div class="hidden md:hidden" id="mobile-menu-items">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">About</a>
                <a href="#achievements" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Achievements</a>
                <a href="#qualification" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Qualification</a>
                <a href="#team" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Team</a>
                <a href="#testimonials" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Testimonials</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Contact</a>
                <!-- <a href="{{ route('admin.login') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700">Admin Login</a> -->
            </div>
        </div>
    </div>
    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-primary to-secondary text-white text-center py-20 md:py-32 relative overflow-hidden" style="padding-top: 80px !important;">
        <div class="shutter shutter-top absolute top-0 left-0 w-full h-1/2 bg-black z-20"></div>
        <div class="shutter shutter-bottom absolute bottom-0 left-0 w-full h-1/2 bg-black z-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <img src="{{ $admin->profile_picture_url ?? 'https://via.placeholder.com/150' }}" alt="Arafat H Shovon" class="w-48 h-48 md:w-64 md:h-64 rounded-full mx-auto mb-6 border-4 border-white shadow-lg transform transition duration-500 hover:scale-105">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in-up">{{ $settings->get('hero_title')->value ?? 'Capturing Moments, Creating Memories' }}</h1>
            <p class="text-lg md:text-2xl mb-8 animate-fade-in-up delay-200">{{ $settings->get('hero_subtitle')->value ?? 'The world through my lens. Explore my collection of photographs.' }}</p>
            <a href="{{ route('galleries.index') }}" target="_blank"
                class="bg-white text-primary font-bold py-3 px-8 md:py-4 md:px-10 rounded-full hover:bg-gray-200 transition duration-300 transform hover:scale-105 shadow-lg">View My Work</a>
        </div>
    </header>

    <!-- About and Skills Section -->
    <section id="about" class="py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 group">
                    <img src="{{ $settings->get('about_me_picture_url')->value ?? 'https://via.placeholder.com/800x600' }}" alt="About Arafat H Shovon" class="rounded-lg shadow-2xl transition duration-500 transform group-hover:scale-105">
                </div>
                <div class="md:w-1/2 md:pl-16 mt-8 md:mt-0">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">About Me</h2>
                    <p class="text-lg md:text-xl text-gray-300 mb-6">{{ $settings->get('about_me_text')->value ?? 'My name is Arafat H Shovon. I am a passionate photographer with a love for capturing the beauty of the world around me. My journey into photography started years ago, and since then, I\'ve been on a constant quest to find and frame moments that tell a story.' }}</p>
                    <h3 class="text-3xl md:text-4xl font-bold mt-10 mb-6">My Skills</h3>
                    <div class="space-y-4">
                        @foreach (explode(',', $settings->get('skills_list')->value ?? 'Portrait Photography,Landscape Photography,Event Photography,Advanced Photo Editing') as $skill)
                            <div class="flex items-center hover:translate-x-2 transition duration-300">
                                <span class="text-primary text-xl md:text-2xl mr-4">&#9679;</span>
                                <span class="text-lg md:text-xl">{{ trim($skill) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-12 bg-secondary">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">Portfolio</h2>
             @if ($portfolios->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($portfolios as $index => $portfolio)
                        @php
                            $colSpanClass = ($index % 3 == 0) ? 'lg:col-span-2' : '';
                        @endphp
                        <a href="{{ Storage::url($portfolio->image_path) }}" data-lightbox="portfolio" data-title="{{ $portfolio->title }}" class="block w-full h-auto md:h-64 overflow-hidden rounded-lg hover:opacity-75 transition-opacity duration-300 {{ $colSpanClass }}">
                            <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-300">No portfolio photos to display.</p>
            @endif
        </div>
    </section>


    <!-- Achievement Section -->
    <section id="achievements" class="py-12 bg-secondary">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">Achievements</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($achievements as $achievement)
                    <div class="bg-gradient-to-br from-[rgb(138,32,11)] to-[rgb(44,26,23)] backdrop-blur-sm border border-white/20 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-primary">
                        @if ($achievement->image_path)
                            <img src="{{ Storage::url($achievement->image_path) }}" alt="{{ $achievement->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-white/5">
                                <i class="fas fa-trophy text-6xl text-yellow-400"></i>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2">{{ $achievement->title }}</h3>
                            <p class="text-gray-300">{{ $achievement->description }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-300">No achievements found.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Qualification Section -->
    <section id="qualification" class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16" style="margin-top: 50px !important;">Qualification</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @forelse ($qualifications as $qualification)
                    <div class="bg-gradient-to-br from-[rgb(138,32,11)] to-[rgb(44,26,23)] backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6 transform transition duration-300 hover:scale-105 hover:shadow-primary">
                        <h3 class="text-2xl font-bold mb-2">{{ $qualification->title }}</h3>
                        <p class="text-gray-300 text-lg">{{ $qualification->description }}</p>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-300">No qualifications found.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-12 bg-secondary">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">My Team</h2>
            <div class="flex flex-wrap justify-center gap-12">
                @forelse ($teamMembers as $member)
                    <div class="text-center transform transition duration-300 hover:scale-105">
                        <img src="{{ $member->image_path ? Storage::url($member->image_path) : 'https://via.placeholder.com/150' }}" alt="{{ $member->name }}" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto mb-4 border-4 border-primary shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold">{{ $member->name }}</h3>
                        <p class="text-gray-300">{{ $member->role }}</p>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-300">No team members found.</p>
                @endforelse
            </div>
        </div>
    </section>
    
    <!-- Testimonial Section -->
    <section id="testimonials" class="py-12 bg-secondary">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">Testimonials</h2>
            <div class="testimonial-swiper swiper-container relative w-full lg:max-w-2xl mx-auto h-[480px] md:h-[400px]">
                <div class="swiper-wrapper">
                    @forelse ($testimonials as $testimonial)
                        <div class="swiper-slide bg-gradient-to-br from-[rgb(138,32,11)] to-[rgb(44,26,23)] backdrop-blur-sm border border-white/20 rounded-lg shadow-xl">
                            <div class="p-6 md:p-8 flex flex-col items-center text-center h-full justify-center">
                                <img src="{{ $testimonial->image_path ? Storage::url($testimonial->image_path) : 'https://via.placeholder.com/150' }}" alt="{{ $testimonial->author }}" class="w-28 h-28 rounded-full object-cover mb-4 border-4 border-white/30 shadow-lg">
                                <div class="mb-4">
                                    <h3 class="text-xl md:text-2xl font-bold text-white">{{ $testimonial->author }}</h3>
                                    @if($testimonial->company)
                                        <p class="text-sm md:text-base text-gray-300">{{ $testimonial->company }}</p>
                                    @endif
                                    {{-- Placeholder for Job Title --}}
                                    <p class="text-xs md:text-sm text-gray-500">Photographer</p>
                                    @if($testimonial->location)
                                        <p class="text-xs md:text-sm text-gray-400">{{ $testimonial->location }}</p>
                                    @endif
                                    {{-- Placeholder for Date --}}
                                    <p class="text-xs md:text-sm text-gray-500 mt-1">Posted: February 2026</p>
                                </div>
                                <p class="text-base md:text-lg italic text-gray-200 overflow-y-auto max-h-[120px] relative before:content-['\201C'] before:absolute before:left-0 before:text-4xl before:top-0 before:text-white/20 after:content-['\201D'] after:absolute after:right-0 after:bottom-0 after:text-4xl after:text-white/20">{{ $testimonial->quote }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide p-2 flex items-center justify-center">
                            <p class="text-center text-gray-300 text-lg">No testimonials found.</p>
                        </div>
                    @endforelse
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white">
        <div class="container mx-auto py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Column 1: Brand -->
                <div class="text-center md:text-left">
                    <h3 class="text-xl md:text-2xl font-bold mb-4">Arafat H Shovon</h3>
                    <p class="text-gray-400 mb-4">
                        Passionate photographer capturing life's fleeting moments with creativity and a unique perspective.
                    </p>
                    <div class="flex justify-center md:justify-start space-x-4">
                        @if($settings->get('facebook_link')->value)
                            <a href="{{ $settings->get('facebook_link')->value }}" target="_blank" class="text-gray-400 hover:text-primary transition duration-300">
                                <i class="fab fa-facebook-f fa-lg"></i>
                            </a>
                        @endif
                        @if($settings->get('instagram_link')->value)
                            <a href="{{ $settings->get('instagram_link')->value }}" target="_blank" class="text-gray-400 hover:text-primary transition duration-300">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        @endif
                        @if($settings->get('twitter_link')->value)
                            <a href="{{ $settings->get('twitter_link')->value }}" target="_blank" class="text-gray-400 hover:text-primary transition duration-300">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg md:text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#about" class="text-gray-400 hover:text-primary transition duration-300">About</a></li>
                        <li><a href="#achievements" class="text-gray-400 hover:text-primary transition duration-300">Achievements</a></li>
                        <li><a href="#qualification" class="text-gray-400 hover:text-primary transition duration-300">Qualification</a></li>
                        <li><a href="#team" class="text-gray-400 hover:text-primary transition duration-300">Team</a></li>
                        <li><a href="#testimonials" class="text-gray-400 hover:text-primary transition duration-300">Testimonials</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg md:text-xl font-bold mb-4">Contact Info</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center justify-center md:justify-start">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>{{ $settings->get('contact_phone')->value ?? '+123 456 7890' }}</span>
                        </li>
                        <li class="flex items-center justify-center md:justify-start">
                            <i class="fas fa-envelope mr-3"></i>
                            <a href="mailto:{{ $settings->get('contact_email')->value ?? 'contact@arafatshovon.com' }}" class="hover:text-primary transition duration-300">{{ $settings->get('contact_email')->value ?? 'contact@arafatshovon.com' }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Bottom Bar -->
        <div class="bg-gray-800 py-4">
            <div class="container mx-auto px-4 text-center text-gray-500">
                &copy; {{ date('Y') }} Arafat H Shovon. All Rights Reserved.
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>

</html>