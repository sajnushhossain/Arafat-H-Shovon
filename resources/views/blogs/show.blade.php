<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>{{ $blog->title }} - Arafat H Shovon</title>

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
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('blogs.index') }}" class="inline-flex items-center text-gray-400 hover:text-white mb-8 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Blogs
                </a>
                
                <div class="w-full aspect-video md:aspect-[21/9] overflow-hidden rounded-2xl shadow-2xl mb-12">
                    <img src="{{ Storage::url($blog->image_path) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $blog->title }}</h1>
                <p class="text-gray-400 mb-8">{{ $blog->created_at->format('F d, Y') }}</p>
                
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 md:p-12 shadow-2xl">
                    <div class="prose prose-invert prose-lg max-w-none">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500">&copy; {{ date('Y') }} Arafat H Shovon. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>