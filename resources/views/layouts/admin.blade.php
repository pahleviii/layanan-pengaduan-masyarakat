<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin Panel - Sistem Pengaduan Masyarakat')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap"/>
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
    <style>body { font-family: "Public Sans", sans-serif; }</style>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">
<div class="flex h-screen w-full overflow-hidden">
    <!-- Sidebar -->
    <aside class="hidden lg:flex w-64 flex-col bg-[#0f172a] text-white shrink-0">
        <div class="flex h-16 items-center px-6 border-b border-slate-700/50">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-white">
                    <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                </div>
                <div>
                    <h1 class="text-base font-bold leading-none tracking-tight">Admin Panel</h1>
                    <p class="text-xs text-slate-400 font-medium mt-1">Sistem Pengaduan</p>
                </div>
            </div>
        </div>
        <div class="flex flex-1 flex-col justify-between overflow-y-auto py-4">
            <nav class="flex flex-col gap-1 px-3">
                <p class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Menu</p>
                <a class="group flex items-center gap-3 rounded-lg px-3 py-2.5 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="group flex items-center gap-3 rounded-lg px-3 py-2.5 transition-colors {{ request()->routeIs('admin.pengaduan.*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}" href="{{ route('admin.pengaduan.index') }}">
                    <span class="material-symbols-outlined text-[20px]">assignment</span>
                    <span class="text-sm font-medium">Pengaduan</span>
                </a>
                <a class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white transition-colors" href="{{ route('home') }}">
                    <span class="material-symbols-outlined text-[20px]">public</span>
                    <span class="text-sm font-medium">Lihat Website</span>
                </a>
            </nav>
            <div class="px-3">
                <div class="rounded-xl bg-slate-800/50 p-4 border border-slate-700/50">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold text-sm shrink-0">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <p class="truncate text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="truncate text-xs text-slate-400">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg border border-slate-600 bg-transparent py-1.5 text-xs font-medium text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-[16px]">logout</span>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex flex-1 flex-col overflow-y-auto bg-background-light dark:bg-background-dark">
        <div class="lg:hidden flex items-center justify-between p-4 bg-white border-b border-slate-200 sticky top-0 z-40">
            <div class="font-bold">Admin Panel</div>
            <button class="text-slate-500" onclick="document.getElementById('admin-mobile-menu').classList.toggle('hidden')">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
        <div id="admin-mobile-menu" class="hidden lg:hidden bg-[#0f172a] px-4 py-3 space-y-1">
            <a class="block text-sm font-medium py-2 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="block text-sm font-medium py-2 {{ request()->routeIs('admin.pengaduan.*') ? 'text-white' : 'text-slate-400' }}" href="{{ route('admin.pengaduan.index') }}">Pengaduan</a>
            <a class="block text-sm font-medium py-2 text-slate-400" href="{{ route('home') }}">Lihat Website</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="block text-sm font-medium py-2 text-red-400">Sign Out</button>
            </form>
        </div>
        <div class="p-6 md:p-8">
            <div class="mx-auto w-full max-w-7xl flex flex-col gap-6">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </main>
</div>
@stack('scripts')
</body>
</html>
