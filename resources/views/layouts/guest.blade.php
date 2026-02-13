<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .blob { animation: blob-bounce 10s infinite ease-in-out; }
            @keyframes blob-bounce {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
            }
            .animation-delay-2000 { animation-delay: 2s; }
        </style>
    </head>
    <body class="bg-slate-50 text-slate-900 antialiased min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 relative overflow-hidden selection:bg-blue-500 selection:text-white">
        
        <div class="fixed inset-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-[80px] opacity-60 blob"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-100 rounded-full mix-blend-multiply filter blur-[80px] opacity-60 blob animation-delay-2000"></div>
        </div>

        <div class="mb-8">
            <a href="/" class="text-4xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-500">
                LARALEARN
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </body>
</html>