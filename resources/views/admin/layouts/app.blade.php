<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <header class="bg-white shadow-md">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-semibold text-blue-600 hover:text-blue-800 transition duration-200">
                    Photography Admin
                </a>

                <div class="relative" x-data="{ open: false }">
                    <!-- Navigation Dropdown Toggle -->
                    <button @click="open = !open" class="text-gray-500 hover:text-blue-700 transition duration-200 focus:outline-none flex items-center space-x-2">
                        <span class="text-lg font-medium">Arafat H Shovon</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Navigation Dropdown -->
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-64 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none z-50">
                        <div class="py-1">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.dashboard')) bg-blue-50 text-blue-700 font-medium @endif">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.galleries.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.galleries.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Galleries
                            </a>
                            <a href="{{ route('admin.portfolios.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.portfolios.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Portfolio
                            </a>
                            <a href="{{ route('admin.achievements.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.achievements.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Achievements
                            </a>
                            <a href="{{ route('admin.qualifications.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.qualifications.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Qualifications
                            </a>
                            <a href="{{ route('admin.team-members.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.team-members.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Team Members
                            </a>
                            <a href="{{ route('admin.testimonials.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.testimonials.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Testimonials
                            </a>
                            <a href="{{ route('admin.settings.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 @if(request()->routeIs('admin.settings.*')) bg-blue-50 text-blue-700 font-medium @endif">
                                Settings
                            </a>
                        </div>
                        <div class="border-t border-gray-100"></div>
                        <div class="py-1">
                            <span class="block px-4 py-2 text-sm text-gray-700">@auth Welcome, {{ Auth::user()->name }} @endauth</span>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200 focus:outline-none">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</body>
</html>
