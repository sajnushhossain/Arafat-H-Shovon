@extends('layouts.admin-dashboard')

@section('title', 'Manage Photos - ' . $internationalProject->title)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Manage Photos for: {{ $internationalProject->title }}</h1>
            <a href="{{ route('admin.international-projects.index') }}" class="text-blue-500 hover:text-blue-700">Back to Projects</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Upload New Photo</h2>
            <form action="{{ route('admin.international-projects.photos.store', $internationalProject->slug) }}" method="POST" enctype="multipart/form-data" x-data="{ uploading: false }" x-on:submit="uploading = true">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Photo Title (Optional)</label>
                        <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="url" class="block text-gray-700 font-bold mb-2">URL (Optional)</label>
                        <input type="url" name="url" id="url" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="https://example.com">
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-700 font-bold mb-2">Photo</label>
                        <input type="file" name="photo" id="photo" class="w-full" required>
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description (Optional)</label>
                    <textarea name="description" id="description" rows="2" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50" x-bind:disabled="uploading">
                        <span x-show="!uploading">Upload Photo</span>
                        <span x-show="uploading">Uploading...</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($internationalProject->photos as $photo)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ Storage::url($photo->file_path) }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold truncate">{{ $photo->title ?? 'Untitled' }}</h3>
                        @if($photo->url)
                            <p class="text-sm text-blue-500 truncate"><a href="{{ $photo->url }}" target="_blank">{{ $photo->url }}</a></p>
                        @endif
                        <div class="mt-4 flex justify-end">
                            <form action="{{ route('admin.international-projects.photos.destroy', [$internationalProject->slug, $photo->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
