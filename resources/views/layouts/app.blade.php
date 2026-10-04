<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Sistem Pengaduan Masyarakat')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body { font-family: "Public Sans", sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-white">
<!-- Header / Navbar -->
<div class="w-full bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-8 h-8 flex items-center justify-center bg-primary rounded-lg text-white">
                    <span class="material-symbols-outlined">campaign</span>
                </div>
                <h2 class="text-xl font-bold tracking-tight text-[#0d141b] dark:text-white">SPM Online</h2>
            </a>
            <div class="hidden md:flex items-center gap-8">
                <nav class="flex gap-6">
                    <a class="text-sm font-medium {{ request()->routeIs('home') ? 'text-primary' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary/80 transition-colors" href="{{ route('home') }}">Beranda</a>
                    <a class="text-sm font-medium {{ request()->routeIs('lapor*') ? 'text-primary' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary transition-colors" href="{{ route('lapor') }}">Buat Pengaduan</a>
                    <a class="text-sm font-medium {{ request()->routeIs('lacak*') ? 'text-primary' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary transition-colors" href="{{ route('lacak') }}">Lacak Pengaduan</a>
                    <a class="text-sm font-medium {{ request()->routeIs('transparansi') ? 'text-primary' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary transition-colors" href="{{ route('transparansi') }}">Pengaduan Selesai</a>
                </nav>
                <a href="{{ route('admin.login') }}" class="bg-primary hover:bg-blue-600 text-white text-sm font-bold py-2.5 px-6 rounded-lg transition-colors shadow-sm text-center">
                    Masuk / Daftar
                </a>
            </div>
            <div class="md:hidden">
                <button class="text-slate-600 dark:text-slate-300" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </header>
    </div>
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 px-4 py-3 space-y-2 bg-white">
        <a class="block text-sm font-medium py-2" href="{{ route('home') }}">Beranda</a>
        <a class="block text-sm font-medium py-2 text-primary" href="{{ route('lapor') }}">Buat Pengaduan</a>
        <a class="block text-sm font-medium py-2 text-slate-600" href="{{ route('lacak') }}">Lacak Pengaduan</a>
        <a class="block text-sm font-medium py-2 text-slate-600" href="{{ route('transparansi') }}">Pengaduan Selesai</a>
    </div>
</div>

@yield('content')

<!-- Footer -->
<footer class="bg-white dark:bg-slate-950 border-t border-gray-200 dark:border-gray-800 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 flex items-center justify-center bg-primary rounded-lg text-white">
                        <span class="material-symbols-outlined">campaign</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-[#0d141b] dark:text-white">SPM Online</h2>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">
                    Sistem Pengaduan Masyarakat adalah platform digital untuk menjembatani aspirasi masyarakat dengan pemerintah demi pembangunan yang lebih baik.
                </p>
            </div>
            <div class="col-span-1">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="{{ route('tentang') }}">Tentang Kami</a></li>
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="{{ route('faq') }}">Prosedur Pengaduan</a></li>
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="{{ route('transparansi') }}">Statistik Laporan</a></li>
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="{{ route('kontak') }}">Hubungi Kami</a></li>
                </ul>
            </div>
            <div class="col-span-1">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">Bantuan</h3>
                <ul class="space-y-3">
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="{{ route('faq') }}">FAQ</a></li>
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="#">Syarat &amp; Ketentuan</a></li>
                    <li><a class="text-slate-600 dark:text-slate-400 hover:text-primary text-sm" href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="col-span-1">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">Kontak</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <span class="material-symbols-outlined text-primary text-lg">location_on</span>
                        Jl. Merdeka No. 45, Jakarta Pusat
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <span class="material-symbols-outlined text-primary text-lg">call</span>
                        (021) 123-4567
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-400">
                        <span class="material-symbols-outlined text-primary text-lg">mail</span>
                        lapor@spm.go.id
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-100 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-400 text-sm text-center md:text-left">© {{ date('Y') }} Sistem Pengaduan Masyarakat. All rights reserved.</p>
            <div class="flex gap-6">
                <a class="text-slate-400 hover:text-slate-600 text-sm" href="#">Privacy Policy</a>
                <a class="text-slate-400 hover:text-slate-600 text-sm" href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
@stack('scripts')
</body>
</html>
