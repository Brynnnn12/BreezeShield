<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - The PHP Framework for Web Artisans</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Instrument Sans', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        'laravel': '#FF2D20',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .dark .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #581c87 100%);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-slide-up {
            animation: slideInUp 0.8s ease-out forwards;
        }

        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-purple-900 text-gray-900 dark:text-white transition-colors duration-300">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect" x-data="{ isOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <h1 class="text-2xl font-bold text-laravel">Laravel</h1>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="px-4 py-2 rounded-lg bg-laravel text-white hover:bg-red-600 transition-colors duration-200 font-medium">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-gray-700 dark:text-gray-300 hover:text-laravel transition-colors duration-200 font-medium">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="px-4 py-2 rounded-lg bg-laravel text-white hover:bg-red-600 transition-colors duration-200 font-medium">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif

                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode"
                            class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" x-cloak>
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="isOpen = !isOpen" class="p-2">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': isOpen, 'inline-flex': !isOpen }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !isOpen, 'inline-flex': isOpen }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="isOpen" x-transition class="md:hidden glass-effect border-t">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium bg-laravel text-white">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200 dark:hover:bg-gray-700">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium bg-laravel text-white">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center px-4 pt-20">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-1/4 left-1/4 w-64 h-64 bg-purple-300 dark:bg-purple-600 rounded-full mix-blend-multiply dark:mix-blend-normal filter blur-xl opacity-70 animate-float">
            </div>
            <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-yellow-300 dark:bg-yellow-600 rounded-full mix-blend-multiply dark:mix-blend-normal filter blur-xl opacity-70 animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 bg-pink-300 dark:bg-pink-600 rounded-full mix-blend-multiply dark:mix-blend-normal filter blur-xl opacity-70 animate-float"
                style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto text-center">
            <!-- Laravel Logo -->
            <div class="mb-8 animate-slide-up">
                <svg class="w-48 h-auto mx-auto text-laravel" viewBox="0 0 438 104" fill="currentColor">
                    <path d="M17.2036 -3H0V102.197H49.5189V86.7187H17.2036V-3Z" />
                    <path
                        d="M110.256 41.6337C108.061 38.1275 104.945 35.3731 100.905 33.3681C96.8667 31.3647 92.8016 30.3618 88.7131 30.3618C83.4247 30.3618 78.5885 31.3389 74.201 33.2923C69.8111 35.2456 66.0474 37.928 62.9059 41.3333C59.7643 44.7401 57.3198 48.6726 55.5754 53.1293C53.8287 57.589 52.9572 62.274 52.9572 67.1813C52.9572 72.1925 53.8287 76.8995 55.5754 81.3069C57.3191 85.7173 59.7636 89.6241 62.9059 93.0293C66.0474 96.4361 69.8119 99.1155 74.201 101.069C78.5885 103.022 83.4247 103.999 88.7131 103.999C92.8016 103.999 96.8667 102.997 100.905 100.994C104.945 98.9911 108.061 96.2359 110.256 92.7282V102.195H126.563V32.1642H110.256V41.6337ZM108.76 75.7472C107.762 78.4531 106.366 80.8078 104.572 82.8112C102.776 84.8161 100.606 86.4183 98.0637 87.6206C95.5202 88.823 92.7004 89.4238 89.6103 89.4238C86.5178 89.4238 83.7252 88.823 81.2324 87.6206C78.7388 86.4183 76.5949 84.8161 74.7998 82.8112C73.004 80.8078 71.6319 78.4531 70.6856 75.7472C69.7356 73.0421 69.2644 70.1868 69.2644 67.1821C69.2644 64.1758 69.7356 61.3205 70.6856 58.6154C71.6319 55.9102 73.004 53.5571 74.7998 51.5522C76.5949 49.5495 78.738 47.9451 81.2324 46.7427C83.7252 45.5404 86.5178 44.9396 89.6103 44.9396C92.7012 44.9396 95.5202 45.5404 98.0637 46.7427C100.606 47.9451 102.776 49.5487 104.572 51.5522C106.367 53.5571 107.762 55.9102 108.76 58.6154C109.756 61.3205 110.256 64.1758 110.256 67.1821C110.256 70.1868 109.756 73.0421 108.76 75.7472Z" />
                    <path
                        d="M242.805 41.6337C240.611 38.1275 237.494 35.3731 233.455 33.3681C229.416 31.3647 225.351 30.3618 221.262 30.3618C215.974 30.3618 211.138 31.3389 206.75 33.2923C202.36 35.2456 198.597 37.928 195.455 41.3333C192.314 44.7401 189.869 48.6726 188.125 53.1293C186.378 57.589 185.507 62.274 185.507 67.1813C185.507 72.1925 186.378 76.8995 188.125 81.3069C189.868 85.7173 192.313 89.6241 195.455 93.0293C198.597 96.4361 202.361 99.1155 206.75 101.069C211.138 103.022 215.974 103.999 221.262 103.999C225.351 103.999 229.416 102.997 233.455 100.994C237.494 98.9911 240.611 96.2359 242.805 92.7282V102.195H259.112V32.1642H242.805V41.6337ZM241.31 75.7472C240.312 78.4531 238.916 80.8078 237.122 82.8112C235.326 84.8161 233.156 86.4183 230.614 87.6206C228.07 88.823 225.251 89.4238 222.16 89.4238C219.068 89.4238 216.275 88.823 213.782 87.6206C211.289 86.4183 209.145 84.8161 207.35 82.8112C205.554 80.8078 204.182 78.4531 203.236 75.7472C202.286 73.0421 201.814 70.1868 201.814 67.1821C201.814 64.1758 202.286 61.3205 203.236 58.6154C204.182 55.9102 205.554 53.5571 207.35 51.5522C209.145 49.5495 211.288 47.9451 213.782 46.7427C216.275 45.5404 219.068 44.9396 222.16 44.9396C225.251 44.9396 228.07 45.5404 230.614 46.7427C233.156 47.9451 235.326 49.5487 237.122 51.5522C238.917 53.5571 240.312 55.9102 241.31 58.6154C242.306 61.3205 242.806 64.1758 242.806 67.1821C242.805 70.1868 242.305 73.0421 241.31 75.7472Z" />
                    <path d="M438 -3H421.694V102.197H438V-3Z" />
                    <path d="M139.43 102.197H155.735V48.2834H183.712V32.1665H139.43V102.197Z" />
                    <path
                        d="M324.49 32.1665L303.995 85.794L283.498 32.1665H266.983L293.748 102.197H314.242L341.006 32.1665H324.49Z" />
                    <path
                        d="M376.571 30.3656C356.603 30.3656 340.797 46.8497 340.797 67.1828C340.797 89.6597 356.094 104 378.661 104C391.29 104 399.354 99.1488 409.206 88.5848L398.189 80.0226C398.183 80.031 389.874 90.9895 377.468 90.9895C363.048 90.9895 356.977 79.3111 356.977 73.269H411.075C413.917 50.1328 398.775 30.3656 376.571 30.3656ZM357.02 61.0967C357.145 59.7487 359.023 43.3761 376.442 43.3761C393.861 43.3761 395.978 59.7464 396.099 61.0967H357.02Z" />
                </svg>
            </div>

            <!-- Hero Content -->
            <div class="space-y-6 animate-slide-up" style="animation-delay: 0.2s;">
                <h1
                    class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    The PHP Framework
                </h1>
                <h2 class="text-3xl md:text-5xl font-semibold text-gray-800 dark:text-gray-200">
                    for Web Artisans
                </h2>
                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto leading-relaxed">
                    Laravel is a web application framework with expressive, elegant syntax.
                    We've already laid the foundation — freeing you to create without sweating the small things.
                </p>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-12 animate-slide-up"
                style="animation-delay: 0.4s;">
                <a href="https://laravel.com/docs"
                    class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-laravel rounded-xl hover:bg-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Documentation
                </a>
                <a href="https://laracasts.com"
                    class="inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-800 dark:text-white bg-white dark:bg-gray-800 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1a3 3 0 000-6h-1m4 6h1a3 3 0 000-6h-1m-2 8v2a2 2 0 002 2h2a2 2 0 002-2v-2" />
                    </svg>
                    Laracasts
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 px-4" x-data="{ inView: false }" x-intersect.once="inView = true">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    Why Choose Laravel?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Laravel combines simplicity with powerful features to help you build amazing applications.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700"
                    x-show="inView" x-transition:enter="transition ease-out duration-600"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Rapid Development</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Built-in tools and conventions help you develop applications faster with less code and more
                        functionality.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700"
                    x-show="inView" x-transition:enter="transition ease-out duration-600 delay-150"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Security First</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Laravel provides security features out of the box, including authentication, authorization, and
                        protection against common vulnerabilities.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700"
                    x-show="inView" x-transition:enter="transition ease-out duration-600 delay-300"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Developer Experience</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Elegant syntax, comprehensive documentation, and an amazing community make Laravel a joy to work
                        with.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Getting Started Section -->
    <section class="py-24 px-4 bg-gray-50 dark:bg-gray-900" x-data="{ inView: false }" x-intersect.once="inView = true">
        <div class="max-w-4xl mx-auto text-center">
            <div x-show="inView" x-transition:enter="transition ease-out duration-800"
                x-transition:enter-start="opacity-0 transform translate-y-8"
                x-transition:enter-end="opacity-100 transform translate-y-0">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-8">
                    Ready to Get Started?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-12 leading-relaxed">
                    Join thousands of developers who choose Laravel for their next project.
                    Experience the joy of elegant, expressive syntax.
                </p>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-2xl border border-gray-200 dark:border-gray-700">
                    <div class="bg-gray-900 dark:bg-black rounded-xl p-6 text-left overflow-x-auto">
                        <div class="flex items-center mb-4">
                            <div class="flex space-x-2">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            </div>
                            <span class="ml-4 text-gray-400 text-sm">Terminal</span>
                        </div>
                        <code class="text-green-400 font-mono text-lg">
                            $ composer create-project laravel/laravel my-app<br>
                            $ cd my-app<br>
                            $ php artisan serve
                        </code>
                    </div>
                </div>

                <div class="mt-12">
                    <a href="https://cloud.laravel.com"
                        class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-laravel to-pink-600 rounded-xl hover:from-red-600 hover:to-pink-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                        Deploy Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 px-4" x-data="{ inView: false, stats: { downloads: 0, packages: 0, contributors: 0, stars: 0 } }" x-intersect.once="inView = true; animateStats()">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                    <div class="text-4xl md:text-5xl font-bold text-laravel mb-2"
                        x-text="stats.downloads.toLocaleString() + 'M+'">200M+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-semibold">Downloads</div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                    <div class="text-4xl md:text-5xl font-bold text-purple-600 mb-2"
                        x-text="stats.packages.toLocaleString() + 'K+'">30K+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-semibold">Packages</div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2"
                        x-text="stats.contributors.toLocaleString() + '+'">2K+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-semibold">Contributors</div>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                    <div class="text-4xl md:text-5xl font-bold text-green-600 mb-2"
                        x-text="stats.stars.toLocaleString() + 'K+'">75K+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-semibold">GitHub Stars</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 px-4 bg-gradient-to-r from-purple-600 to-pink-600">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Loved by Developers Worldwide
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" x-data="{
                testimonials: [
                    { name: 'Sarah Johnson', role: 'Senior Developer', company: 'TechCorp', text: 'Laravel has transformed how we build web applications. The elegant syntax and powerful features make development a breeze.' },
                    { name: 'Mike Chen', role: 'CTO', company: 'StartupXYZ', text: 'We chose Laravel for our platform and it was the best decision. The ecosystem is incredible and the community is amazing.' },
                    { name: 'Emma Wilson', role: 'Full Stack Developer', company: 'Digital Agency', text: 'Laravel Eloquent ORM is a game-changer. Building complex database relationships has never been this intuitive.' }
                ]
            }">
                <template x-for="(testimonial, index) in testimonials" :key="index">
                    <div class="bg-white bg-opacity-10 backdrop-blur-lg p-8 rounded-2xl text-white" x-show="true"
                        x-transition:enter="transition ease-out duration-600"
                        x-transition:enter-start="opacity-0 transform translate-y-8"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        :style="`animation-delay: ${index * 200}ms;`">
                        <div class="mb-6">
                            <svg class="w-10 h-10 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <p class="text-lg mb-6 leading-relaxed" x-text="testimonial.text"></p>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                                <span class="text-lg font-bold" x-text="testimonial.name.charAt(0)"></span>
                            </div>
                            <div>
                                <div class="font-semibold" x-text="testimonial.name"></div>
                                <div class="text-white text-opacity-70"
                                    x-text="`${testimonial.role} at ${testimonial.company}`"></div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold text-laravel mb-4">Laravel</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        The PHP Framework for Web Artisans. Laravel is a web application framework with expressive,
                        elegant syntax.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://github.com/laravel/laravel"
                            class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.374 0 0 5.373 0 12 0 17.302 3.438 21.8 8.207 23.387c.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                        <a href="https://twitter.com/laravelphp"
                            class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="https://laravel.com/docs"
                                class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="https://laracasts.com" class="hover:text-white transition-colors">Laracasts</a>
                        </li>
                        <li><a href="https://laravel-news.com" class="hover:text-white transition-colors">Laravel
                                News</a></li>
                        <li><a href="https://forge.laravel.com" class="hover:text-white transition-colors">Forge</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Community</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="https://github.com/laravel" class="hover:text-white transition-colors">GitHub</a>
                        </li>
                        <li><a href="https://discord.gg/laravel"
                                class="hover:text-white transition-colors">Discord</a></li>
                        <li><a href="https://twitter.com/laravelphp"
                                class="hover:text-white transition-colors">Twitter</a></li>
                        <li><a href="https://laravel.io" class="hover:text-white transition-colors">Forum</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">
                    © 2024 Laravel. Built with ❤️ by the Laravel community.
                </p>
            </div>
        </div>
    </footer>

    <script>
        function animateStats() {
            const targets = {
                downloads: 200,
                packages: 30,
                contributors: 2,
                stars: 75
            };
            const duration = 2000;
            const steps = 60;
            const stepDuration = duration / steps;

            Object.keys(targets).forEach(key => {
                let current = 0;
                const target = targets[key];
                const increment = target / steps;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    this.stats[key] = Math.floor(current);
                }, stepDuration);
            });
        }
    </script>
</body>

</html>
