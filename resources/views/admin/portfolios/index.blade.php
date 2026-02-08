@extends('admin.layouts.app')

@section('title', 'Portfolio')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Portfolio</h1>
            <a href="{{ route('admin.portfolios.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Item
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Image
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($portfolios as $portfolio)
                            <tr>
                                                                                                                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                                                                                                    <div class="w-20 h-20 flex items-center justify-center bg-gray-100 rounded-md overflow-hidden">
                                                                                                                                                        <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="object-contain max-w-full max-h-full">
                                                                                                                                                    </div>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                                                                                                    <p class="text-gray-900 whitespace-nowrap overflow-hidden text-ellipsis">{{ $portfolio->title }}</p>
                                                                                                                                                </td>
                                                                                                                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                                                                                                    <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                                                                                                                        @csrf
                                                                                                                                                        @method('DELETE')
                                                                                                                                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                                                                                                                    </form>
                                                                                                                                                </td>                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-10">No portfolio items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
