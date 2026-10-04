@extends('layouts.app')

@section('title', 'Pengaduan Selesai - Sistem Pengaduan Masyarakat')

@section('content')
<main class="flex-1 flex flex-col items-center py-8 px-4 md:px-10 lg:px-40">
    <div class="w-full max-w-7xl flex flex-col gap-8">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col gap-2">
                <h1 class="text-[#0d141b] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Pengaduan yang Telah Selesai</h1>
                <p class="text-[#4c739a] dark:text-gray-400 text-base font-normal leading-normal max-w-2xl">
                    Transparansi publik untuk laporan masyarakat yang telah berhasil ditindaklanjuti dan diselesaikan oleh pihak terkait.
                </p>
            </div>
            <form action="{{ route('transparansi') }}" method="GET" class="bg-white dark:bg-[#1e2a38] p-4 rounded-xl shadow-sm border border-[#e7edf3] dark:border-gray-700 flex flex-col lg:flex-row gap-4 items-center justify-between">
                <div class="flex flex-1 flex-col sm:flex-row gap-4 w-full">
                    <div class="relative flex-1 min-w-[200px]">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#4c739a]">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input name="q" value="{{ $query }}" class="form-input block w-full pl-10 pr-3 py-2.5 border border-[#cfdbe7] rounded-lg text-sm bg-slate-50 text-[#0d141b] placeholder:text-[#4c739a] focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Cari nomor tiket atau judul..." type="text"/>
                        <input type="hidden" name="kategori" value="{{ $kategori }}"/>
                    </div>
                </div>
                <div class="flex items-center gap-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0">
                    <span class="text-sm font-medium text-[#4c739a] dark:text-gray-400 whitespace-nowrap mr-2">Kategori:</span>
                    @foreach ($filters as $filter)
                        <a href="{{ route('transparansi', ['q' => $query, 'kategori' => $filter]) }}" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg px-4 transition {{ $kategori === $filter ? 'bg-primary text-white hover:opacity-90' : 'bg-[#e7edf3] dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                            <span class="text-sm font-medium leading-normal {{ $kategori === $filter ? '' : 'text-[#0d141b] dark:text-gray-200' }}">{{ $filter }}</span>
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        @if ($complaints->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($complaints as $item)
                    <div class="group flex flex-col bg-white dark:bg-[#1e2a38] rounded-xl shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-[#e7edf3] dark:border-gray-700 h-full">
                        <div class="relative h-48 w-full bg-gray-200 overflow-hidden">
                            @if ($item->foto_path)
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style='background-image: url("{{ asset('storage/'.$item->foto_path) }}");'></div>
                            @else
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style='background-image: url("https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=800&q=80");'></div>
                            @endif
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 border border-emerald-200">
                                    <span class="material-symbols-outlined !text-[14px]">check_circle</span>
                                    Selesai
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col flex-1 p-5 gap-3">
                            <div class="flex justify-between items-start gap-2">
                                <span class="text-xs font-mono font-medium text-[#4c739a] dark:text-gray-400 bg-slate-100 dark:bg-gray-800 px-2 py-1 rounded">#{{ $item->ticket_number }}</span>
                                <span class="text-xs font-medium text-[#4c739a] dark:text-gray-400 flex items-center gap-1">
                                    <span class="material-symbols-outlined !text-[14px]">calendar_month</span> {{ $item->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <h3 class="text-[#0d141b] dark:text-white text-lg font-bold leading-tight line-clamp-2 min-h-[3.5rem]">
                                {{ $item->judul }}
                            </h3>
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-[#e7edf3] dark:border-gray-700">
                                <span class="inline-flex items-center text-xs font-medium text-[#4c739a] dark:text-gray-400">
                                    <span class="material-symbols-outlined !text-[16px] mr-1">sell</span>
                                    {{ $item->kategori }}
                                </span>
                                <a href="{{ route('lacak.show', ['ticket' => $item->ticket_number]) }}" class="text-primary hover:text-blue-700 text-sm font-bold flex items-center gap-1 transition-colors">
                                    Lihat Detail
                                    <span class="material-symbols-outlined !text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined !text-[48px] text-gray-400">inbox</span>
                </div>
                <h3 class="text-xl font-bold text-[#0d141b] mb-2">Belum ada pengaduan yang diselesaikan</h3>
                <p class="text-[#4c739a] max-w-sm">Coba ubah filter pencarian Anda atau cek kembali nanti untuk melihat pembaruan.</p>
            </div>
        @endif

        @if ($complaints->hasPages())
            <div class="flex items-center justify-center gap-2 mt-8">
                @if ($complaints->onFirstPage())
                    <span class="flex items-center justify-center w-10 h-10 rounded-lg border border-[#cfdbe7] bg-white text-gray-300">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $complaints->previousPageUrl() }}" class="flex items-center justify-center w-10 h-10 rounded-lg border border-[#cfdbe7] bg-white text-[#0d141b] hover:bg-slate-50">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                @endif
                @foreach ($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                    @if ($page == $complaints->currentPage())
                        <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary text-white font-medium shadow-sm ring-2 ring-offset-2 ring-primary ring-offset-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 rounded-lg border border-[#cfdbe7] bg-white text-[#0d141b] hover:bg-slate-50 font-medium">{{ $page }}</a>
                    @endif
                @endforeach
                @if ($complaints->hasMorePages())
                    <a href="{{ $complaints->nextPageUrl() }}" class="flex items-center justify-center w-10 h-10 rounded-lg border border-[#cfdbe7] bg-white text-[#0d141b] hover:bg-slate-50">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                @else
                    <span class="flex items-center justify-center w-10 h-10 rounded-lg border border-[#cfdbe7] bg-white text-gray-300">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </span>
                @endif
            </div>
        @endif
    </div>
</main>
@endsection
