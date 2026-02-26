<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TaskFlow') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Navigation --}}
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-6 h-14 flex items-center justify-between">
            <a href="{{ url('/') }}" class="font-semibold text-gray-900 tracking-tight flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                TaskFlow
            </a>
            <div class="flex items-center gap-1">
                <a href="{{ route('projects.index') }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-150
                   {{ request()->routeIs('projects.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                    Projects
                </a>
                <a href="{{ route('tasks.index') }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-150
                   {{ request()->routeIs('tasks.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                    Tasks
                </a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-1 max-w-5xl w-full mx-auto px-6 py-8">
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 py-4 text-center text-xs text-gray-400">
        TaskFlow &copy; {{ date('Y') }}
    </footer>

</body>
</html>
