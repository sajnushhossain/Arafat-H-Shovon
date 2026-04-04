<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>Blogs - Arafat H Shovon</title>

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
            <h1 class="text-4xl md:text-6xl font-bold mb-12 text-center">My Blogs</h1>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($blogs as $blog)
                    <div class="group bg-gradient-to-br from-[rgb(138,32,11)] to-[rgb(44,26,23)] backdrop-blur-sm border border-white/20 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-primary flex flex-col h-full">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="block overflow-hidden aspect-video">
                            <img src="{{ Storage::url($blog->image_path) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110 group-hover:opacity-80">
                        </a>
                        <div class="p-6 flex flex-col flex-grow">
                            <p class="text-gray-400 text-sm mb-2">{{ $blog->created_at->format('M d, Y') }}</p>
                            <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-gray-300 transition duration-300 line-clamp-2">{{ $blog->title }}</h3>
                            <div class="mt-auto">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="inline-block bg-white text-primary font-bold py-2 px-6 rounded-full hover:bg-gray-200 transition duration-300">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-400 text-xl">No blogs found.</p>
                    </div>
                @endforelse
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