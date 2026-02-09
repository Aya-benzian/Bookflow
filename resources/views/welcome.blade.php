<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">


        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-secondary text-text">
        <div class="min-h-screen flex flex-col justify-between">
            <header class="bg-secondary-dark shadow p-4">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <svg class="h-8 w-8 text-primary fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M4 19V6.5C4 5.67157 4.67157 5 5.5 5H19C19.8284 5 20.5 5.67157 20.5 6.5V19C20.5 19.8284 19.8284 20.5 19 20.5H5.5C4.67157 20.5 4 19.8284 4 19ZM5.5 6.5V19H19V6.5H5.5ZM12 8.5C12 8.22386 12.2239 8 12.5 8H17.5C17.7761 8 18 8.22386 18 8.5V9.5C18 9.77614 17.7761 10 17.5 10H12.5C12.2239 10 12 9.77614 12 9.5V8.5Z" />
                        </svg>
                    </a>
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary bg-secondary hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </nav>
            </header>

            <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 text-center">
                <div class="max-w-3xl mx-auto">
                    <h1 class="text-5xl font-extrabold text-primary sm:text-6xl md:text-7xl">
                        <span class="block">Welcome to</span>
                        <span class="block text-accent">The Modern Library</span>
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-xl text-text-light">
                        Discover, borrow, and manage your favorite books with ease. Your ultimate digital library experience starts here.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('livres.index') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-light md:py-4 md:text-lg md:px-10 shadow-lg">
                            Browse Books
                        </a>
                        @guest
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-primary text-base font-medium rounded-md text-primary bg-secondary hover:bg-secondary-dark md:py-4 md:text-lg md:px-10 shadow-lg">
                                Get Started
                            </a>
                        @endguest
                    </div>
                </div>
            </main>

            <footer class="bg-secondary-dark shadow p-4 mt-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-text-light text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </div>
            </footer>
        </div>
    </body>
</html>