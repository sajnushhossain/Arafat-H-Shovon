@extends('layouts.guest')

@section('content')
    <body class="bg-secondary text-white">
        <div class="container mx-auto px-4 py-16">
            <h1 class="text-5xl font-bold text-center mb-4 text-white">{{ $gallery->title }}</h1>
            <p class="text-xl text-gray-300 text-center mb-12">{{ $gallery->description }}</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse ($gallery->photos as $photo)
                    <div class="bg-gradient-to-br from-primary to-secondary rounded-lg shadow-2xl overflow-hidden">
                        <a href="{{ Storage::url($photo->file_path) }}" data-lightbox="gallery" data-title="{{ $photo->title }}">
                            <img src="{{ Storage::url($photo->file_path) }}" alt="{{ $photo->title }}" class="w-full h-64 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-white">{{ $photo->title }}</h3>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-300">No photos in this gallery yet.</p>
                @endforelse
            </div>
            <div class="mt-12 text-center">
                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">&larr; Back to home</a>
            </div>
        </div>
    </body>
@endsection

@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
@endpush
