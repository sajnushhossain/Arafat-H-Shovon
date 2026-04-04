@extends('admin.layouts.app')

@section('title', 'Edit Blog')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">Edit Blog</h1>
                <a href="{{ route('admin.blogs.index') }}" class="text-blue-500 hover:text-blue-700 transition duration-150">Back to List</a>
            </div>

            <form action="{{ route('admin.blogs.update', $blog->slug) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('title', $blog->title) }}" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Card Image</label>
                    <img src="{{ Storage::url($blog->image_path) }}" alt="{{ $blog->title }}" class="h-32 w-32 object-cover rounded shadow-sm mb-2">
                    <label for="image_path" class="block text-sm font-medium text-gray-700 mb-1">Update Image (Optional)</label>
                    <input type="file" name="image_path" id="image_path" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('image_path')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="content" id="content" rows="15" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('content', $blog->content) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">You can use HTML for links and formatting.</p>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition duration-150">
                        Update Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection