@extends('layouts.app')

@section('title', 'Hubungi Kami - Sistem Pengaduan Masyarakat')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-[#2563eb] to-[#1e40af] py-16 md:py-20 px-4">
    <div class="max-w-[960px] mx-auto text-center text-white">
        <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Hubungi Kami</h1>
        <p class="text-blue-100 text-lg md:text-xl font-normal max-w-2xl mx-auto leading-relaxed">
            Kami siap mendengar aspirasi, keluhan, dan saran Anda. Hubungi kami melalui formulir di bawah ini atau kunjungi kantor pelayanan kami.
        </p>
    </div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 pointer-events-none"></div>
</section>

<!-- Main Content Container -->
<main class="flex-grow w-full max-w-[1280px] mx-auto px-4 sm:px-10 py-12 -mt-10 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Contact Form -->
        <div class="lg:col-span-2 bg-white dark:bg-surface-dark rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-6 md:p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-[#111318] dark:text-white mb-2">Formulir Pengaduan &amp; Kontak</h2>
                <p class="text-[#616e89] dark:text-gray-400">Silakan isi formulir di bawah ini dengan data yang valid agar kami dapat segera memproses permintaan Anda.</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex gap-3 items-start">
                    <span class="material-symbols-outlined mt-0.5">check_circle</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    <p class="font-bold text-sm mb-2">Periksa kembali isian formulir:</p>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kontak.kirim') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111318] dark:text-gray-200 text-sm font-semibold leading-normal pb-2">Nama Lengkap</p>
                        <input name="nama" value="{{ old('nama') }}" class="w-full rounded-xl border border-[#dbdee6] focus:border-primary focus:ring-1 focus:ring-primary h-12 px-4 placeholder:text-[#9aa2b1] text-base transition-colors" placeholder="Contoh: Budi Santoso" type="text"/>
                    </label>
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111318] dark:text-gray-200 text-sm font-semibold leading-normal pb-2">Alamat Email</p>
                        <input name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-[#dbdee6] focus:border-primary focus:ring-1 focus:ring-primary h-12 px-4 placeholder:text-[#9aa2b1] text-base transition-colors" placeholder="nama@email.com" type="email"/>
                    </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111318] dark:text-gray-200 text-sm font-semibold leading-normal pb-2">Nomor Telepon</p>
                        <input name="telepon" value="{{ old('telepon') }}" class="w-full rounded-xl border border-[#dbdee6] focus:border-primary focus:ring-1 focus:ring-primary h-12 px-4 placeholder:text-[#9aa2b1] text-base transition-colors" placeholder="+62 812-3456-7890" type="tel"/>
                    </label>
                    <label class="flex flex-col flex-1">
                        <p class="text-[#111318] dark:text-gray-200 text-sm font-semibold leading-normal pb-2">Kategori Pengaduan</p>
                        <div class="relative">
                            <select name="kategori" class="w-full rounded-xl border border-[#dbdee6] focus:border-primary focus:ring-1 focus:ring-primary h-12 px-4 text-base transition-colors appearance-none cursor-pointer bg-white">
                                <option disabled value="" {{ old('kategori') ? '' : 'selected' }}>Pilih kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('kategori') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none text-xl">expand_more</span>
                        </div>
                    </label>
                </div>
                <label class="flex flex-col flex-1">
                    <p class="text-[#111318] dark:text-gray-200 text-sm font-semibold leading-normal pb-2">Pesan Pengaduan</p>
                    <textarea name="pesan" class="w-full rounded-xl border border-[#dbdee6] focus:border-primary focus:ring-1 focus:ring-primary min-h-40 px-4 py-3 placeholder:text-[#9aa2b1] text-base transition-colors resize-none" placeholder="Jelaskan detail pengaduan Anda secara lengkap...">{{ old('pesan') }}</textarea>
                </label>
                <div class="pt-2">
                    <button type="submit" class="flex w-full md:w-auto min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-12 px-6 bg-primary hover:bg-blue-700 text-white text-base font-bold tracking-wide transition-all shadow-lg shadow-blue-500/30">
                        <span class="mr-2">Kirim Pesan</span>
                        <span class="material-symbols-outlined text-[20px]">send</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Column: Contact Info & Map -->
        <div class="flex flex-col gap-6">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-6">Informasi Kontak</h3>
                <div class="flex flex-col gap-6">
                    <div class="flex gap-4 items-start">
                        <div class="flex-shrink-0 size-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#111318] mb-1">Alamat Kantor</h4>
                            <p class="text-sm text-[#616e89] leading-relaxed">Jl. Merdeka Raya No. 45, Gedung Pelayanan Publik Lt. 1, Jakarta Pusat, 10110</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="flex-shrink-0 size-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#111318] mb-1">Telepon &amp; Hotline</h4>
                            <p class="text-sm text-[#616e89] mb-1">(021) 555-0123 (Kantor)</p>
                            <p class="text-sm text-[#616e89]">112 (Darurat)</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="flex-shrink-0 size-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#111318] mb-1">Email Resmi</h4>
                            <p class="text-sm text-[#616e89]">pengaduan@pemerintah.go.id</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start border-t border-gray-100 pt-5 mt-1">
                        <div class="flex-shrink-0 size-10 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-[#111318] mb-1">Jam Operasional</h4>
                            <p class="text-sm text-[#616e89] flex justify-between gap-4 w-full">
                                <span>Senin - Jumat</span>
                                <span class="font-medium text-gray-900">08:00 - 16:00 WIB</span>
                            </p>
                            <p class="text-sm text-[#616e89] flex justify-between gap-4 w-full mt-1">
                                <span>Sabtu - Minggu</span>
                                <span class="font-medium text-red-500">Tutup</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden h-64 relative">
                <iframe title="Peta lokasi kantor" class="w-full h-full border-0" loading="lazy" src="https://www.openstreetmap.org/export/embed.html?bbox=106.7900%2C-6.2200%2C106.8500%2C-6.1700&amp;layer=mapnik&amp;marker=-6.1950%2C106.8200"></iframe>
                <a href="https://www.openstreetmap.org/?mlat=-6.1950&amp;mlon=106.8200#map=15/-6.1950/106.8200" target="_blank" class="absolute bottom-4 left-4 bg-white/90 backdrop-blur text-xs font-bold px-4 py-2 rounded-full shadow-lg text-slate-800 flex items-center gap-2 hover:bg-white">
                    <span class="material-symbols-outlined text-red-500 text-sm">location_on</span>
                    Lihat di Peta
                </a>
            </div>
        </div>
    </div>

    <!-- FAQ Quick Links Section -->
    <section class="mt-12 mb-8">
        <h3 class="text-2xl font-bold text-[#111318] mb-6 text-center">Pertanyaan Umum (FAQ)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $links = [
                    ['icon' => 'search', 'judul' => 'Cara Melacak Tiket?', 'desc' => 'Panduan memeriksa status laporan Anda.', 'url' => route('faq', ['kategori' => 'Lacak Status'])],
                    ['icon' => 'timer', 'judul' => 'Waktu Respons?', 'desc' => 'Estimasi waktu penanganan pengaduan.', 'url' => route('faq', ['kategori' => 'Proses Pengaduan'])],
                    ['icon' => 'lock', 'judul' => 'Kerahasiaan Data?', 'desc' => 'Kebijakan privasi pelapor.', 'url' => route('faq', ['kategori' => 'Privasi'])],
                    ['icon' => 'help', 'judul' => 'Bantuan Teknis?', 'desc' => 'Hubungi admin untuk masalah website.', 'url' => route('faq', ['kategori' => 'Teknis'])],
                ];
            @endphp
            @foreach ($links as $link)
                <a class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-primary/50 shadow-sm hover:shadow-md transition-all" href="{{ $link['url'] }}">
                    <div class="size-10 rounded-full bg-blue-50 text-primary flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">{{ $link['icon'] }}</span>
                    </div>
                    <h4 class="font-bold text-[#111318] mb-1 group-hover:text-primary transition-colors">{{ $link['judul'] }}</h4>
                    <p class="text-sm text-[#616e89]">{{ $link['desc'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
</main>
@endsection
