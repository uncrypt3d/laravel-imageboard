<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>laravel-imageboard-base</title>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav class="bg-grey shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <a href="{{ route('boards.index') }}" class="text-gray-700 text-lg font-semibold py-4 px-2">Home</a>
                    @auth
                        <a href="{{ route('boards.create') }}" class="text-gray-700 text-lg font-semibold py-4 px-2">Create Board (not working)</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.index') }}" class="text-gray-700 text-lg font-semibold py-4 px-2">Admin Panel (not working)</a>
                        @endif
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 text-lg font-semibold py-4 px-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 text-lg font-semibold py-4 px-2">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 text-lg font-semibold py-4 px-2">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</body>
</html>
