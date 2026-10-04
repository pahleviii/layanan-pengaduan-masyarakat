@extends('layouts.app')

@section('title', 'FAQ - Sistem Pengaduan Masyarakat')

@push('styles')
<style>
    details > summary { list-style: none; }
    details > summary::-webkit-details-marker { display: none; }
    details[open] summary ~ * { animation: sweep .3s ease-in-out; }
    @keyframes sweep {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    details[open] summary .expand-icon { transform: rotate(180deg); }
    .expand-icon { transition: transform 0.3s ease; }
</style>
@endpush

@section('content')
<main class="flex-grow flex flex-col items-center">
    <!-- Hero Section -->
    <div class="w-full bg-gradient-to-br from-[#2563eb] to-[#1e40af] px-4 py-16 md:py-24 flex justify-center items-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="flex flex-col max-w-[800px] w-full z-10 text-center gap-8">
            <div class="flex flex-col gap-4">
                <h1 class="text-white text-4xl md:text-5xl font-black leading-tight tracking-[-0.033em]">
                    Pertanyaan yang Sering Diajukan
                </h1>
                <h2 class="text-blue-100 text-lg font-normal leading-relaxed max-w-2xl mx-auto">
                    Temukan jawaban cepat seputar proses pengaduan, pelacakan status, dan privasi data Anda di sini.
                </h2>
            </div>
            <div class="w-full max-w-[600px] mx-auto">
                <form action="{{ route('faq') }}" method="GET" class="flex w-full flex-1 items-stretch rounded-xl h-14 md:h-16 bg-white overflow-hidden shadow-lg">
                    <div class="text-[#616e89] flex items-center justify-center pl-5 pr-2">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input name="q" value="{{ $query }}" class="flex w-full flex-1 bg-transparent text-[#111318] focus:outline-0 placeholder:text-[#616e89] text-base font-normal px-2 border-none focus:ring-0" placeholder="Cari pertanyaan atau topik (misal: cara melapor)..."/>
                    <div class="flex items-center justify-center pr-2">
                        <button type="submit" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-primary hover:bg-blue-700 text-white text-sm font-bold transition-colors">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Container -->
    <div class="flex w-full flex-col max-w-[1024px] px-4 md:px-8 -mt-8 mb-20">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 z-20">
            <div class="flex flex-col items-center justify-center gap-1 rounded-xl p-6 bg-white shadow-md border border-[#dbdee6]/50 text-center">
                <div class="p-3 bg-blue-50 text-primary rounded-full mb-2">
                    <span class="material-symbols-outlined">help_center</span>
                </div>
                <p class="text-[#111318] tracking-light text-2xl font-bold leading-tight">50+</p>
                <p class="text-slate-500 text-sm font-medium leading-normal">Pertanyaan Terjawab</p>
            </div>
            <div class="flex flex-col items-center justify-center gap-1 rounded-xl p-6 bg-white shadow-md border border-[#dbdee6]/50 text-center">
                <div class="p-3 bg-green-50 text-green-600 rounded-full mb-2">
                    <span class="material-symbols-outlined">category</span>
                </div>
                <p class="text-[#111318] tracking-light text-2xl font-bold leading-tight">{{ count($categories) }}</p>
                <p class="text-slate-500 text-sm font-medium leading-normal">Kategori Topik</p>
            </div>
            <div class="flex flex-col items-center justify-center gap-1 rounded-xl p-6 bg-white shadow-md border border-[#dbdee6]/50 text-center">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-full mb-2">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <p class="text-[#111318] tracking-light text-2xl font-bold leading-tight">10k+</p>
                <p class="text-slate-500 text-sm font-medium leading-normal">Pengguna Terbantu</p>
            </div>
        </div>

        @if ($searching)
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-[#111318] text-xl font-bold leading-tight">Hasil pencarian "{{ $query }}"</h3>
                    <a href="{{ route('faq') }}" class="text-sm font-bold text-primary hover:underline">Reset</a>
                </div>
                @forelse ($items as $index => $item)
                    <details class="group bg-white rounded-xl shadow-sm border border-[#dbdee6] overflow-hidden" {{ $index === 0 ? 'open' : '' }}>
                        <summary class="flex cursor-pointer list-none items-center justify-between p-6 bg-white hover:bg-slate-50 transition-colors relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary rounded-l-xl opacity-0 group-open:opacity-100 transition-opacity"></div>
                            <span class="text-[#111318] text-lg font-bold leading-tight group-open:text-primary transition-colors pr-4">
                                {{ $item['q'] }}
                                <span class="ml-2 text-xs font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded">{{ $item['kategori'] }}</span>
                            </span>
                            <div class="text-slate-400 group-open:text-primary expand-icon shrink-0">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-6 pb-6 pt-0 text-slate-600 text-base leading-relaxed">
                            <div class="border-t border-dashed border-slate-200 pt-4 mt-2">{{ $item['a'] }}</div>
                        </div>
                    </details>
                @empty
                    <div class="bg-white rounded-xl border border-[#dbdee6] p-10 text-center">
                        <p class="font-bold text-lg mb-1">Tidak ada hasil</p>
                        <p class="text-slate-500 text-sm">Coba kata kunci lain atau <a href="{{ route('kontak') }}" class="text-primary font-bold">hubungi kami</a>.</p>
                    </div>
                @endforelse
            </div>
        @else
            <!-- Category Filters -->
            <div class="flex flex-col gap-6 mb-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-[#111318] text-xl font-bold leading-tight">Kategori Topik</h3>
                </div>
                <div class="flex gap-3 overflow-x-auto pb-2">
                    @foreach ($categories as $cat)
                        <a href="{{ route('faq', ['kategori' => $cat]) }}" class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-xl px-6 transition-colors {{ $kategori === $cat ? 'bg-primary shadow-sm ring-2 ring-primary ring-offset-2' : 'bg-white border border-[#dbdee6] hover:bg-slate-50' }}">
                            <span class="text-sm leading-normal {{ $kategori === $cat ? 'text-white font-bold' : 'text-[#111318] font-medium' }}">{{ $cat }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- FAQ Accordion List -->
            <div class="flex flex-col gap-4">
                @foreach ($items as $index => $item)
                    <details class="group bg-white rounded-xl shadow-sm border border-[#dbdee6] overflow-hidden" {{ $index === 0 ? 'open' : '' }}>
                        <summary class="flex cursor-pointer list-none items-center justify-between p-6 bg-white hover:bg-slate-50 transition-colors relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary rounded-l-xl opacity-0 group-open:opacity-100 transition-opacity"></div>
                            <span class="text-[#111318] text-lg font-bold leading-tight group-open:text-primary transition-colors pr-4">{{ $item['q'] }}</span>
                            <div class="text-slate-400 group-open:text-primary expand-icon shrink-0">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-6 pb-6 pt-0 text-slate-600 text-base leading-relaxed">
                            <div class="border-t border-dashed border-slate-200 pt-4 mt-2">{{ $item['a'] }}</div>
                        </div>
                    </details>
                @endforeach
            </div>
        @endif

        <!-- CTA Section -->
        <div class="mt-12 w-full">
            <div class="bg-blue-800 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-5 rounded-full pointer-events-none"></div>
                <div class="absolute right-20 -bottom-10 w-20 h-20 bg-white opacity-5 rounded-full pointer-events-none"></div>
                <div class="flex flex-col gap-3 text-center md:text-left z-10">
                    <h2 class="text-white text-2xl font-bold leading-tight">Masih butuh bantuan?</h2>
                    <p class="text-blue-100 text-base font-normal max-w-md">
                        Jika pertanyaan Anda belum terjawab di atas, tim dukungan kami siap membantu Anda menyelesaikan masalah.
                    </p>
                </div>
                <div class="flex gap-4 z-10">
                    <a href="{{ route('kontak') }}" class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-xl h-12 px-6 bg-white hover:bg-blue-50 text-primary text-base font-bold transition-colors shadow-lg">
                        <span class="mr-2 material-symbols-outlined text-[20px]">support_agent</span>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
