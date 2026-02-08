@extends('layouts.guest')

@section('content')
    <body class="bg-secondary text-white">
        <div class="container mx-auto px-4 py-16">
            <h1 class="text-5xl font-bold text-center mb-16 text-white">All Galleries</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse ($galleries as $gallery)
                    <a href="{{ route('galleries.show', $gallery->slug) }}" class="block">
                        <div class="bg-gradient-to-br from-primary to-secondary rounded-lg shadow-2xl overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-primary h-full">
                            <div class="p-6">
                                <h2 class="text-3xl font-bold mb-2 text-white">{{ $gallery->title }}</h2>
                                <p class="text-gray-300 text-lg">{{ Str::limit($gallery->description, 100) }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-center col-span-full text-gray-300">No galleries found.</p>
                @endforelse
            </div>
        </div>
    </body>
@endsection

@push('scripts')
    {{-- No longer needed here as photos are shown on individual gallery pages --}}
@endpush
