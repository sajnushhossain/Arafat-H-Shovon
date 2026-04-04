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

    <main class="flex-grow py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-12 text-center tracking-tight">About Myself</h1>
            
            <div class="max-w-4xl mx-auto space-y-12">
                <!-- Bio Section -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 md:p-16 shadow-2xl">
                    <div class="prose prose-invert prose-lg max-w-none text-gray-200">
                        @if(isset($settings['about_myself_content']))
                            {!! $settings['about_myself_content']?->value !!}
                        @else
                            <p class="text-center text-gray-400 font-medium">Bio coming soon...</p>
                        @endif
                    </div>
                </div>

                <!-- Educational Background Section -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl">
                    <h2 class="text-3xl font-bold mb-8 text-primary flex items-center">
                        <i class="fas fa-graduation-cap mr-4"></i> Educational Background
                    </h2>
                    <div class="space-y-6">
                        @forelse($education as $index => $item)
                            <div class="flex gap-6 items-start group">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center text-primary font-bold border border-primary/30 group-hover:bg-primary group-hover:text-white transition duration-300">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-grow pb-6 border-b border-white/5 last:border-0">
                                    <span class="text-sm font-bold text-gray-400 tracking-wider uppercase">{{ $item->year }}</span>
                                    <h3 class="text-xl font-bold text-white mt-1">{{ $item->degree }}</h3>
                                    <p class="text-gray-400 font-medium mt-1">{{ $item->institution }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 italic">No educational background added yet.</p>
                        @endforelse
                    </div>
                </div>

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
                            <p class="text-gray-400 italic">No languages added yet.</p>
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
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-auto border-t border-white/5">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500 font-medium">&copy; {{ date('Y') }} Arafat H Shovon. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>