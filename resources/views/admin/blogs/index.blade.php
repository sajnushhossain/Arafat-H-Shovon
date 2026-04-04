@extends('admin.layouts.app')

@section('title', 'Blogs')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 border-b-4 border-blue-500 pb-2">Manage Blogs</h1>
            <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 ring-blue-500 ring-offset-2 transition ease-in-out duration-150 shadow-md">
                <i class="fas fa-plus-circle mr-2"></i> Add New Blog Post
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg shadow-sm flex items-center" role="alert">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <div>
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Blog Preview
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Title & URL
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Published Date
                            </th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($blogs as $blog)
                            <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-20 w-32 flex-shrink-0 overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                                        <img src="{{ Storage::url($blog->image_path) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $blog->title }}</div>
                                    <div class="text-xs text-gray-400 mt-1 flex items-center">
                                        <i class="fas fa-link mr-1"></i> /blogs/{{ $blog->slug }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center space-x-4">
                                        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="text-gray-500 hover:text-blue-600 transition-colors flex items-center" title="View Public Post">
                                            <i class="fas fa-external-link-alt mr-1"></i> View
                                        </a>
                                        <a href="{{ route('admin.blogs.edit', $blog->slug) }}" class="text-indigo-600 hover:text-indigo-800 transition-colors flex items-center" title="Edit Content">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog->slug) }}" method="POST" class="inline-block" onsubmit="return confirm('Permanently delete this blog post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition-colors flex items-center" title="Delete Blog">
                                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-100 p-6 rounded-full mb-4">
                                            <i class="fas fa-feather-alt text-5xl text-gray-300"></i>
                                        </div>
                                        <p class="text-xl font-medium">No blog posts found.</p>
                                        <p class="text-gray-400 mt-1">Start sharing your stories with the world!</p>
                                        <a href="{{ route('admin.blogs.create') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                            Create My First Blog
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection