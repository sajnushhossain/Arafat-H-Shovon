@extends('layouts.admin-dashboard')

@section('title', 'Manage Gallery: ' . $gallery->title)

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manage Photos for "{{ $gallery->title }}"</h1>
        <a href="{{ route('admin.galleries.photos.create', $gallery) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
            Add New Photo
        </a>
    </div>

    @if($gallery->photos->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">No Photos Found</p>
            <p>This gallery doesn't have any photos yet. Click the "Add New Photo" button to get started.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($gallery->photos as $photo)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $photo->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $photo->description }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.galleries.photos.edit', [$gallery, $photo]) }}" class="text-sm text-blue-500 hover:text-blue-700 font-semibold">Edit</a>
                            <form action="{{ route('admin.galleries.photos.destroy', [$gallery, $photo]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
