@extends('layouts.app')

@section('title', 'Sistem Pengaduan Masyarakat')

@section('content')
<!-- Hero Section -->
<div class="relative w-full overflow-hidden bg-slate-900">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/40 z-10"></div>
        <div class="h-full w-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBqTZjB9dwhjn4JNxoQ0sNfzBewedllEtSd2IApd1uHRKnG6VNRUpyzF90GXL_ss4nImvt_j-6WYu1ZTcV8c-ZZWRB4IyqZk3uvwwkBh38DDESaA3QyiDKWnMYWCiUJ-XukEBg1VQqeHCKx8hG8-VukS1FsWeXgFFPVT6SwaI8lvVwHWUZ3_xrU6QtJK8VPcGEbYdKsIpeB30LzDIQL_6tceiFWcz8lqsVVt5nLJa-cthlRh7DOoo_Ggdxb2jy1qUuKJL4R7AVBN7Sp");'></div>
    </div>
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-2xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight mb-6">
                Sampaikan Aspirasi Anda, <span class="text-primary">Kami Siap Mendengarkan</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-300 mb-8 leading-relaxed max-w-xl">
                Layanan aspirasi dan pengaduan online rakyat. Laporkan masalah di lingkungan Anda dengan mudah, cepat, dan transparan demi kemajuan bersama.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('lapor') }}" class="bg-primary hover:bg-blue-600 text-white text-base font-bold py-3.5 px-8 rounded-lg shadow-lg hover:shadow-primary/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">edit_square</span>
                    Buat Pengaduan Baru
                </a>
                <a href="{{ route('lacak') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/20 text-base font-bold py-3.5 px-8 rounded-lg transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">search</span>
                    Lacak Status Laporan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="w-full bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-gray-800 -mt-8 relative z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 -translate-y-1/2 md:-translate-y-1/2 pb-12 md:pb-0">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-3xl">folder_open</span>
                </div>
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Total Pengaduan</p>
                    <p class="text-3xl font-black text-slate-900 dark:text-white">{{ number_format($total) }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center text-orange-500">
                    <span class="material-symbols-outlined text-3xl">engineering</span>
                </div>
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Sedang Diproses</p>
                    <p class="text-3xl font-black text-slate-900 dark:text-white">{{ number_format($diproses) }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center text-green-500">
                    <span class="material-symbols-outlined text-3xl">check_circle</span>
                </div>
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Selesai</p>
                    <p class="text-3xl font-black text-slate-900 dark:text-white">{{ number_format($selesai) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="py-16 w-full bg-background-light dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Kategori Pengaduan</h2>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Pilih kategori yang sesuai dengan masalah yang ingin Anda laporkan untuk mempercepat proses penanganan oleh petugas terkait.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $categories = [
                    ['label' => 'Jalan Rusak', 'icon' => 'add_road'],
                    ['label' => 'Kebersihan', 'icon' => 'delete'],
                    ['label' => 'Lampu Jalan', 'icon' => 'light_mode'],
                    ['label' => 'Saluran Air', 'icon' => 'water_drop'],
                    ['label' => 'Fasilitas Umum', 'icon' => 'park'],
                    ['label' => 'Lainnya', 'icon' => 'more_horiz'],
                ];
            @endphp
            @foreach ($categories as $cat)
                <a class="group flex flex-col items-center p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:border-primary hover:shadow-md transition-all" href="{{ route('lapor', ['kategori' => $cat['label']]) }}">
                    <div class="w-12 h-12 mb-3 rounded-full bg-slate-100 dark:bg-slate-700 group-hover:bg-blue-50 dark:group-hover:bg-blue-900/20 flex items-center justify-center text-slate-600 dark:text-slate-300 group-hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">{{ $cat['icon'] }}</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-primary text-center">{{ $cat['label'] }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Recent Resolved Section -->
<div class="py-16 w-full bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Pengaduan Selesai Terbaru</h2>
                <p class="text-slate-600 dark:text-slate-400 mt-2">Lihat bagaimana kami menyelesaikan laporan masyarakat.</p>
            </div>
            <a class="text-primary font-bold hover:text-blue-700 inline-flex items-center gap-1" href="{{ route('transparansi') }}">
                Lihat Semua
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($latestResolved as $item)
                <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
                    <div class="h-48 w-full bg-gray-200 relative">
                        @if ($item->foto_path)
                            <div class="absolute inset-0 bg-cover bg-center" style='background-image: url("{{ asset('storage/'.$item->foto_path) }}");'></div>
                        @else
                            <div class="absolute inset-0 bg-cover bg-center" style='background-image: url("https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=800&q=80");'></div>
                        @endif
                        <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            Selesai
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-sm text-slate-400">calendar_today</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-xs text-primary font-medium bg-blue-50 dark:bg-blue-900/30 px-2 py-0.5 rounded">{{ $item->kategori }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2">{{ $item->judul }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-3 mb-4">{{ $item->deskripsi }}</p>
                        <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500">
                                <span class="material-symbols-outlined text-sm">person</span>
                            </div>
                            @php
                                $inisial = collect(preg_split('/\s+/', trim($item->nama ?? '')))
                                    ->filter()
                                    ->map(fn ($kata) => mb_strtoupper(mb_substr($kata, 0, 1)).'.')
                                    ->implode('');
                            @endphp
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $inisial !== '' ? $inisial : 'Warga' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-slate-500 col-span-3 text-center">Belum ada pengaduan selesai.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
