<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">
        <!-- Backdrop for mobile sidebar -->
        <div x-show="sidebarOpen" x-transition.opacity.duration.500ms class="fixed inset-0 bg-gray-900 bg-opacity-75 z-20 md:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <div class="fixed z-30 inset-y-0 left-0 w-64 transform bg-white shadow-xl border-r border-gray-200 overflow-y-auto transition ease-in-out duration-300"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
            @click.away="sidebarOpen = false">
            <div class="flex items-center justify-center px-4 py-6">
                <h2 class="text-2xl font-semibold text-blue-600">{{ config('app.name', 'Laravel') }} Admin</h2>
                <button class="text-gray-500 focus:outline-none md:hidden" @click="sidebarOpen = false">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <nav class="mt-6">
                <ul>
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.dashboard')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.dashboard')) text-blue-600 @else text-gray-500 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12L12 3l9 9v6a1 1 0 01-1 1h-4v-6H8v6H4a1 1 0 01-1-1v-6z"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.galleries.index') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.galleries.*')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.galleries.*')) text-blue-600 @else text-gray-500 @endif" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="4" width="18" height="14" rx="2" ry="2"/><circle cx="8.5" cy="10.5" r="2"/><path d="M21 15l-5-5L9 21l-5-4"/></svg>
                            Galleries
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.achievements.index') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.achievements.*')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.achievements.*')) text-blue-600 @else text-gray-500 @endif" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 2l2.09 6.26L20 9.27l-5 3.64L16.18 20 12 16.9 7.82 20 9 12.91l-5-3.64 5.91-.91L12 2z"/></svg>
                            Achievements
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.qualifications.index') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.qualifications.*')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.qualifications.*')) text-blue-600 @else text-gray-500 @endif" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422M12 14v7"/></svg>
                            Qualifications
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.team-members.index') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.team-members.*')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.team-members.*')) text-blue-600 @else text-gray-500 @endif" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20v-1a4 4 0 00-3-3.87M9 20v-1a4 4 0 013-3.87M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                            Team Members
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.testimonials.index') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.testimonials.*')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.testimonials.*')) text-blue-600 @else text-gray-500 @endif" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12c0 4.418-4.03 8-9 8-1.197 0-2.336-.194-3.363-.55L3 20l1.551-3.667C3.616 15.133 3 13.62 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Testimonials
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.settings.edit') }}"
                            class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.settings.*')) bg-blue-50 text-blue-700 border-l-4 border-blue-500 @endif font-medium">
                            <svg class="h-5 w-5 mr-3 @if(request()->routeIs('admin.settings.*')) text-blue-600 @else text-gray-500 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                            Settings
                        </a>
                    </li>
                    <li class="mt-4 pt-4 border-t border-gray-200">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center py-2.5 px-4 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition duration-200 w-full text-left font-medium">
                                <svg class="h-5 w-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h1 class="text-2xl font-semibold text-gray-800 ml-4 md:ml-0">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center">
                    <span class="mr-4 text-gray-700 hidden md:block">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 transition duration-200 focus:outline-none">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container px-6 py-8 mx-auto">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>