<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        /* Neutral gradient background for admin area */
        body {
            background: linear-gradient(to right, #f8fafc, #eef2f7);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile overlay -->
        <div id="admin-overlay" class="fixed inset-0 bg-black opacity-50 z-30 hidden md:hidden"></div>

        <!-- Sidebar -->
        <div id="admin-sidebar" class="hidden md:block fixed inset-y-0 left-0 z-40 w-64 bg-slate-800 text-white p-4 md:static md:inset-auto md:w-64 md:min-h-screen shadow-lg">
            <div class="p-4 bg-slate-900 mb-6 rounded-lg shadow-sm flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-semibold text-white">Photography Admin</a>
                <button id="sidebar-close" class="md:hidden text-white p-2 rounded hover:bg-slate-700">
                    <span class="sr-only">Close sidebar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12L12 3l9 9v6a1 1 0 01-1 1h-4v-6H8v6H4a1 1 0 01-1-1v-6z"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                    Settings
                </a>
                <a href="{{ route('admin.achievements.index') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.achievements.*') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.137.42a1 1 0 00.95.69l.494.02c.9 0 1.7.613 1.96 1.47l.098.444c.2.9 1.047 1.427 1.918 1.13l.427-.12c.9-.25 1.9.3 2.2 1.2l.15.44c.3.9 0 1.9-.7 2.4l-.327.23c-.8.56-.8 1.68 0 2.24l.327.23c.7.5 1 1.5.7 2.4l-.15.44c-.3.9-1.3 1.45-2.2 1.2l-.427-.12a1.4 1.4 0 00-1.918 1.13l-.098.444c-.26.857-1.059 1.47-1.96 1.47l-.494.02a1 1 0 00-.95.69l-.137.42c-.3.921-1.602.921-1.902 0l-.137-.42a1 1 0 00-.95-.69l-.494-.02c-.9 0-1.7-.613-1.96-1.47l-.098-.444a1.4 1.4 0 00-1.918-1.13l-.427.12c-.9.25-1.9-.3-2.2-1.2l-.15-.44c-.3-.9 0-1.9.7-2.4l.327-.23c.8-.56.8-1.68 0-2.24l-.327-.23c-.7-.5-1-1.5-.7-2.4l.15-.44c.3-.9 1.3-1.45 2.2-1.2l.427.12c.8.3 1.4-.27 1.918-1.13l.098-.444C7.95 7.02 8.75 6.41 9.65 6.41l.494-.02c.36 0 .69-.25.95-.69l.137-.42z"></path></svg>
                    Achievements
                </a>
                <a href="{{ route('admin.qualifications.index') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.qualifications.*') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422M12 14v7"/></svg>
                    Qualifications
                </a>
                <a href="{{ route('admin.team-members.index') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.team-members.*') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-1a4 4 0 00-3-3.87M9 20v-1a4 4 0 013-3.87M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    Team Members
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.testimonials.*') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8-1.197 0-2.336-.194-3.363-.55L3 20l1.551-3.667C3.616 15.133 3 13.62 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Testimonials
                </a>
                <a href="{{ route('admin.galleries.index') }}"
                    class="flex items-center py-2.5 px-4 rounded-md transition duration-200 hover:bg-slate-700 {{ request()->routeIs('admin.galleries.*') ? 'bg-slate-700' : '' }}">
                    <svg class="h-5 w-5 text-slate-300 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="14" rx="2" ry="2"/><circle cx="8.5" cy="10.5" r="2"/><path d="M21 15l-5-5L9 21l-5-4"/></svg>
                    Galleries & Photos
                </a>
            </nav> 
        </div>

        <!-- Page Content -->
        <main class="flex-1 p-6 bg-white shadow rounded-lg m-4 max-w-7xl mx-auto w-full">
            <!-- Mobile sidebar toggle -->
            <div class="md:hidden mb-4">
                <button id="sidebar-toggle" aria-controls="admin-sidebar" aria-expanded="false" class="p-2 bg-gray-800 text-white rounded">
                    <span class="sr-only">Open sidebar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 110-2zm0 4h14a1 1 0 010 2H3a1 1 0 110-2zm0 4h14a1 1 0 010 2H3a1 1 0 110-2z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            @yield('content')
        </main>
    </div>
</body>

</html>