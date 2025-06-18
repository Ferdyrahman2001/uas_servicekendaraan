<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceKuy - Solusi Perawatan Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 dark:bg-gray-900 dark:text-white">
    <header class="flex items-center justify-between px-6 py-4 shadow-sm dark:bg-gray-800">
        <h1 class="text-xl font-bold">ServiceKuy</h1>
        <nav class="space-x-4">
            @auth
            <a href="{{ url('/admin') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Dashboard
            </a>
            @else
            <a href="{{url('/admin/login')}}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                Log in
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Register
            </a>
            @endif
            @endauth
        </nav>
    </header>

    <main class="flex flex-col md:flex-row items-center justify-between px-6 py-20 max-w-7xl mx-auto">
        <div class="md:w-1/2 space-y-6">
            <h2 class="text-4xl font-bold leading-snug">Solusi Mudah dan Cepat untuk Service Kendaraan Anda</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Dengan <span class="font-semibold">ServiceKuy</span>, Anda dapat menemukan bengkel terdekat, booking
                servis secara online, dan pantau status kendaraan Anda langsung dari aplikasi.
            </p>
            <a href="/admin/login"
                class="inline-block mt-4 bg-yellow-400 text-black px-6 py-2 rounded-lg font-medium hover:bg-yellow-300 transition">
                Mulai Sekarang
            </a>
        </div>
        <div class="md:w-1/2 mt-10 md:mt-0">
            <img src="{{ asset('img/bengkel.jpg') }}" alt="Servis Kendaraan"
                class="rounded-lg shadow-md w-full h-auto">
        </div>
    </main>

    <footer class="text-center text-sm py-6 text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} ServiceKuy. All rights reserved.
    </footer>
</body>

</html>