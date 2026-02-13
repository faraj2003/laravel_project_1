<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laralearn</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .blob { animation: blob-bounce 10s infinite ease-in-out; }
            @keyframes blob-bounce {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
            }
            .animation-delay-2000 { animation-delay: 2s; }
            .animation-delay-4000 { animation-delay: 4s; }
        </style>
    </head>
    <body class="bg-white text-slate-900 min-h-screen flex flex-col relative overflow-hidden selection:bg-blue-500 selection:text-white">
        
        <div class="fixed inset-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-cyan-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-sky-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 blob animation-delay-4000"></div>
        </div>

        @if (Route::has('login'))
            <nav class="w-full p-6 flex justify-end items-center z-50">
                <div class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-blue-600 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-blue-600 transition-colors">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-slate-900 text-white rounded-full font-bold hover:bg-slate-800 transition-transform hover:scale-105 shadow-lg shadow-blue-500/20">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif

        <main class="flex-grow flex flex-col items-center justify-center text-center px-4 z-10">
            
            <h1 class="text-7xl md:text-9xl font-black tracking-tight mb-4 text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-500">
                LARALEARN
            </h1>

            <p class="text-xl md:text-2xl text-slate-600 mb-12 max-w-2xl font-light leading-relaxed">
                Experience the future of student management. <br class="hidden md:block">Seamlessly organize courses, track performance, and empower learning.
            </p>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-full blur opacity-40 group-hover:opacity-75 transition duration-200"></div>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="relative px-12 py-4 bg-white border border-slate-100 rounded-full leading-none flex items-center divide-x divide-slate-200 shadow-xl transition-transform active:scale-95">
                        <span class="flex items-center space-x-5">
                            <span class="pr-6 text-slate-900 font-bold text-xl uppercase tracking-wider">Go to Dashboard</span>
                        </span>
                        <span class="pl-6 text-blue-600 group-hover:text-blue-500 transition duration-200">
                            &rarr;
                        </span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="relative px-12 py-4 bg-blue-600 rounded-full leading-none flex items-center shadow-xl shadow-blue-500/30 transition-transform active:scale-95 hover:bg-blue-500">
                        <span class="text-white font-bold text-xl uppercase tracking-wider mr-3">Get Started</span>
                        <span class="text-white">
                            &rarr;
                        </span>
                    </a>
                @endauth
            </div>

        </main>

        <footer class="w-full p-6 text-center text-slate-400 text-sm">
            &copy; {{ date('Y') }} Laralearn. All rights reserved.
        </footer>
    </body>
</html>