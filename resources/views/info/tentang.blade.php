@extends('layouts.app')

@section('title', 'Tentang Kami - Sistem Pengaduan Masyarakat')

@section('content')
<main class="flex-grow w-full">
    <!-- Hero Section -->
    <section class="relative flex w-full flex-col justify-center overflow-hidden bg-gradient-to-br from-primary to-blue-800 pt-20 pb-24 lg:pt-28 lg:pb-36">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
        <div class="flex justify-center w-full px-6 relative z-10">
            <div class="max-w-[960px] flex flex-col items-center text-center gap-6">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium text-white backdrop-blur-sm border border-white/20">
                    <span class="material-symbols-outlined text-[18px]">info</span>
                    Informasi Publik
                </span>
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-black leading-[1.1] tracking-tight">
                    Tentang Sistem Pengaduan Masyarakat
                </h1>
                <p class="text-blue-100 text-lg md:text-xl font-normal leading-relaxed max-w-[720px]">
                    Membangun pelayanan publik yang transparan, responsif, dan akuntabel. Kami hadir untuk menjembatani aspirasi Anda demi kemajuan bersama.
                </p>
                <div class="flex flex-wrap gap-4 pt-4 justify-center">
                    <a href="#visi-misi" class="flex items-center gap-2 h-12 px-6 rounded-lg bg-white text-primary hover:bg-blue-50 text-base font-bold shadow-lg shadow-blue-900/20 transition-all">
                        <span>Pelajari Lebih Lanjut</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_downward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section (Overlapping) -->
    <section class="relative z-20 -mt-12 px-6">
        <div class="flex justify-center w-full">
            <div class="max-w-[1080px] w-full bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800 p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-100 dark:divide-gray-800">
                    <div class="flex flex-col items-center text-center gap-2 p-2">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full text-primary mb-2">
                            <span class="material-symbols-outlined text-3xl">assignment_turned_in</span>
                        </div>
                        <h3 class="text-3xl font-black text-[#111318] dark:text-white">{{ number_format($totalLaporan) }}+</h3>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Laporan Diterima</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-2 p-2">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full text-primary mb-2">
                            <span class="material-symbols-outlined text-3xl">timelapse</span>
                        </div>
                        <h3 class="text-3xl font-black text-[#111318] dark:text-white">24 Jam</h3>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Rata-rata Respon</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-2 p-2">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full text-primary mb-2">
                            <span class="material-symbols-outlined text-3xl">sentiment_satisfied</span>
                        </div>
                        <h3 class="text-3xl font-black text-[#111318] dark:text-white">98%</h3>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Tingkat Kepuasan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section id="visi-misi" class="py-20 px-6 bg-background-light dark:bg-background-dark">
        <div class="flex justify-center w-full">
            <div class="max-w-[1080px] w-full flex flex-col gap-12">
                <div class="text-center max-w-[720px] mx-auto">
                    <h2 class="text-primary font-bold text-sm tracking-widest uppercase mb-2">Nilai-Nilai Utama</h2>
                    <h3 class="text-[#111318] dark:text-white text-3xl md:text-4xl font-bold tracking-tight mb-4">Visi &amp; Misi Kami</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">
                        Kami berkomitmen untuk memberikan pelayanan terbaik dengan prinsip transparansi dan akuntabilitas tinggi.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="group bg-white dark:bg-surface-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="size-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">visibility</span>
                        </div>
                        <h4 class="text-xl font-bold text-[#111318] dark:text-white mb-3">Visi Kami</h4>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Menjadi platform digital terdepan yang menjembatani aspirasi masyarakat secara real-time demi mewujudkan pelayanan publik yang prima dan inklusif.
                        </p>
                    </div>
                    <div class="group bg-white dark:bg-surface-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="size-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">flag</span>
                        </div>
                        <h4 class="text-xl font-bold text-[#111318] dark:text-white mb-3">Misi Kami</h4>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Memberikan respon cepat, menyediakan pelacakan status laporan yang transparan, dan memastikan solusi tuntas bagi setiap aduan warga.
                        </p>
                    </div>
                    <div class="group bg-white dark:bg-surface-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow">
                        <div class="size-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">shield</span>
                        </div>
                        <h4 class="text-xl font-bold text-[#111318] dark:text-white mb-3">Nilai Dasar</h4>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Menjunjung tinggi integritas, kecepatan respon tanpa kompromi, dan keadilan dalam penanganan setiap laporan yang masuk ke sistem kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 px-6 bg-white dark:bg-surface-dark">
        <div class="flex justify-center w-full">
            <div class="max-w-[1080px] w-full flex flex-col gap-12">
                <div class="text-center">
                    <h3 class="text-[#111318] dark:text-white text-3xl md:text-4xl font-bold tracking-tight mb-4">Tim Kami</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                        Dikelola oleh para profesional yang berdedikasi untuk melayani masyarakat.
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @php
                        $team = [
                            ['nama' => 'Budi Santoso', 'jabatan' => 'Kepala Dinas', 'inisial' => 'BS', 'warna' => 'bg-blue-100 text-blue-700'],
                            ['nama' => 'Siti Aminah', 'jabatan' => 'Koordinator Layanan', 'inisial' => 'SA', 'warna' => 'bg-pink-100 text-pink-700'],
                            ['nama' => 'Reza Pratama', 'jabatan' => 'Manajer IT', 'inisial' => 'RP', 'warna' => 'bg-emerald-100 text-emerald-700'],
                            ['nama' => 'Dewi Kusuma', 'jabatan' => 'Humas & Komunikasi', 'inisial' => 'DK', 'warna' => 'bg-purple-100 text-purple-700'],
                        ];
                    @endphp
                    @foreach ($team as $anggota)
                        <div class="flex flex-col items-center text-center gap-4">
                            <div class="relative size-32 rounded-full overflow-hidden border-4 border-gray-100 dark:border-gray-800 {{ $anggota['warna'] }} flex items-center justify-center">
                                <span class="text-4xl font-black">{{ $anggota['inisial'] }}</span>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-[#111318] dark:text-white">{{ $anggota['nama'] }}</h5>
                                <p class="text-primary text-sm font-medium">{{ $anggota['jabatan'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6 bg-background-light dark:bg-background-dark">
        <div class="flex justify-center w-full">
            <div class="max-w-[1080px] w-full">
                <div class="bg-primary rounded-2xl p-8 md:p-12 lg:p-16 text-center shadow-2xl overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                        <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
                            <pattern height="20" id="dots" patternunits="userSpaceOnUse" width="20" x="0" y="0">
                                <circle cx="2" cy="2" fill="white" r="1"></circle>
                            </pattern>
                            <rect fill="url(#dots)" height="100%" width="100%"></rect>
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col items-center gap-6">
                        <h2 class="text-white text-3xl md:text-4xl font-black tracking-tight max-w-2xl">
                            Siap Melaporkan Masalah di Lingkungan Anda?
                        </h2>
                        <p class="text-blue-100 text-lg max-w-xl">
                            Jangan ragu untuk menyampaikan aspirasi. Identitas Anda aman dan kami siap menindaklanjuti.
                        </p>
                        <a href="{{ route('lapor') }}" class="mt-4 bg-white text-primary hover:bg-gray-100 px-8 h-14 rounded-lg text-lg font-bold shadow-lg transition-colors flex items-center gap-3">
                            <span class="material-symbols-outlined">edit_document</span>
                            Buat Pengaduan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
