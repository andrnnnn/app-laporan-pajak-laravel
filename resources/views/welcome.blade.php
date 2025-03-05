<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 flex flex-col min-h-screen">
        <div class="flex-grow flex items-center justify-center">
            <div class="max-w-3xl w-full text-center p-6 bg-white shadow-lg rounded-lg">
                <img src="{{ asset('logo.png') }}" alt="Logo Perusahaan" class="w-32 mx-auto mb-4">

                <h1 class="text-2xl font-bold text-gray-800">Sistem Informasi Laporan Pajak Penghasilan</h1>
                <p class="text-gray-500 mt-1 text-sm">Aplikasi ini dirancang untuk mempermudah pengelolaan laporan pajak penghasilan secara efisien dan akurat.</p>

                <!-- Informasi Tambahan -->
                <div class="mt-4 text-sm text-gray-600">
                    <p class="font-semibold">Kantor Konsultan Pajak Suwandi Sudarsono & Rekan</p>
                    <p>Izin Praktek: KEP.651/AP.C/PJ/2020</p>
                    <p>Jl. Urip Sumoharjo No.159, Ngronggo, Kec. Kota, Kediri, Jawa Timur</p>
                    <p>081 230 704 337 | <a href="mailto:sudarsonosuwandi01@gmail.com" class="text-blue-600 hover:underline">sudarsonosuwandi01@gmail.com</a></p>
                </div>

                <div class="mt-6 flex justify-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <footer class="mt-6 text-center text-sm text-gray-500">
            <p>© {{ date('Y') }} Kantor Konsultan Pajak Suwandi Sudarsono & Rekan. All rights reserved.</p>
            <p>Dibuat oleh Muhammad Andrian Bhakti Maulana & Delia Saniar Komalasari</p>
            <p>Universitas Nusantara PGRI Kediri</p>
        </footer>
    </body>
</html>
