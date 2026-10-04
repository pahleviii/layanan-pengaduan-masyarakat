@extends('layouts.app')

@section('title', 'Lacak Status Pengaduan - Sistem Pengaduan Masyarakat')

@section('content')
<main class="flex-1 flex flex-col">
    <!-- Search Section -->
    <section class="bg-white px-4 py-12 md:px-10 border-b border-gray-200">
        <div class="max-w-4xl mx-auto flex flex-col gap-6 text-center">
            <div class="flex flex-col gap-2">
                <h1 class="text-[#0d141b] text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Lacak Status Pengaduan
                </h1>
                <p class="text-slate-500 text-base font-normal leading-normal max-w-2xl mx-auto">
                    Pantau perkembangan laporan Anda dengan memasukkan nomor tiket pengaduan yang Anda terima.
                </p>
            </div>
            <div class="w-full max-w-2xl mx-auto mt-4">
                <form action="{{ route('lacak') }}" method="GET" class="relative flex items-center w-full h-14 rounded-xl focus-within:ring-2 focus-within:ring-primary/50 shadow-sm border border-gray-200 bg-gray-50 overflow-hidden group">
                    <div class="grid place-items-center h-full w-12 text-gray-400 group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input name="ticket" value="{{ $ticket }}" class="peer h-full w-full outline-none text-sm text-gray-700 pr-2 bg-transparent placeholder-gray-400 border-none focus:ring-0" placeholder="Masukkan Nomor Tiket (Contoh: ADU-20231012-0001)" type="text"/>
                    <div class="pr-2">
                        <button type="submit" class="h-10 px-6 rounded-lg bg-primary hover:bg-blue-600 text-white font-bold text-sm transition-colors">
                            Lacak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Search Results Area -->
    <section class="flex-1 px-4 py-8 md:px-10 md:py-10">
        <div class="max-w-6xl mx-auto">
            @if ($complaint)
                @php
                    $status = $complaint->status;
                    $badge = [
                        'pending' => ['bg-amber-100 text-amber-700 border-amber-200', 'hourglass_empty', 'Menunggu Verifikasi'],
                        'proses' => ['bg-blue-100 text-blue-700 border-blue-200', 'cached', 'Diproses'],
                        'selesai' => ['bg-green-100 text-green-700 border-green-200', 'check_circle', 'Selesai'],
                        'ditolak' => ['bg-red-100 text-red-700 border-red-200', 'cancel', 'Ditolak'],
                    ][$status];
                    $step = ['pending' => 2, 'proses' => 3, 'selesai' => 4, 'ditolak' => 2][$status];
                @endphp
                <!-- Ticket Header & Actions -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                    <div>
                        <div class="flex items-center gap-3 mb-1 flex-wrap">
                            <h2 class="text-[#0d141b] text-2xl font-bold tracking-tight">Tiket #{{ $complaint->ticket_number }}</h2>
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-sm font-semibold border {{ $badge[0] }}">
                                <span class="material-symbols-outlined text-base">{{ $badge[1] }}</span>
                                {{ $badge[2] }}
                            </span>
                        </div>
                        <p class="text-slate-500 text-sm">Terakhir diperbarui: {{ $complaint->updated_at->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>
                    <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 shadow-sm transition-colors">
                        <span class="material-symbols-outlined text-lg">print</span>
                        Cetak / Download PDF
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Left Column: Timeline -->
                    <div class="lg:col-span-4 flex flex-col gap-6">
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                            <h3 class="font-bold text-lg mb-6 border-b border-gray-100 pb-3">Riwayat Status</h3>
                            <ol class="relative border-l-2 border-gray-200 ml-3 space-y-8">
                                <li class="ml-6">
                                    <span class="absolute flex items-center justify-center w-8 h-8 bg-green-100 rounded-full -left-[17px] ring-4 ring-white">
                                        <span class="material-symbols-outlined text-green-600 text-sm font-bold">check</span>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Laporan Diterima</h3>
                                    <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $complaint->created_at->translatedFormat('d F Y, H:i') }} WIB</time>
                                    <p class="text-sm font-normal text-gray-500">Laporan Anda telah berhasil masuk ke sistem kami.</p>
                                </li>
                                <li class="ml-6">
                                    @if ($step >= 3 || $status === 'selesai')
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-green-100 rounded-full -left-[17px] ring-4 ring-white">
                                            <span class="material-symbols-outlined text-green-600 text-sm font-bold">check</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Verifikasi Admin</h3>
                                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $complaint->updated_at->translatedFormat('d F Y, H:i') }} WIB</time>
                                        <p class="text-sm font-normal text-gray-500">Admin telah memvalidasi kelengkapan data laporan.</p>
                                    @elseif ($status === 'ditolak')
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-red-500 rounded-full -left-[17px] ring-4 ring-white shadow-lg shadow-red-200">
                                            <span class="material-symbols-outlined text-white text-sm">close</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-bold text-red-600">Ditolak</h3>
                                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $complaint->updated_at->translatedFormat('d F Y, H:i') }} WIB</time>
                                        <p class="text-sm font-normal text-gray-500">Laporan tidak valid atau duplikat. Lihat tanggapan admin untuk alasannya.</p>
                                    @else
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-primary rounded-full -left-[17px] ring-4 ring-white shadow-lg shadow-blue-200">
                                            <span class="material-symbols-outlined text-white text-sm animate-pulse">hourglass_empty</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-bold text-primary">Verifikasi Admin</h3>
                                        <p class="text-sm font-normal text-gray-500">Laporan Anda sedang menunggu verifikasi admin.</p>
                                    @endif
                                </li>
                                <li class="ml-6">
                                    @if ($step >= 4)
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-green-100 rounded-full -left-[17px] ring-4 ring-white">
                                            <span class="material-symbols-outlined text-green-600 text-sm font-bold">check</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Sedang Diproses</h3>
                                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $complaint->updated_at->translatedFormat('d F Y, H:i') }} WIB</time>
                                        <p class="text-sm font-normal text-gray-500">Laporan telah ditindaklanjuti oleh dinas terkait.</p>
                                    @elseif ($status === 'proses')
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-primary rounded-full -left-[17px] ring-4 ring-white shadow-lg shadow-blue-200">
                                            <span class="material-symbols-outlined text-white text-sm animate-pulse">cached</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-bold text-primary">Sedang Diproses</h3>
                                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $complaint->updated_at->translatedFormat('d F Y, H:i') }} WIB</time>
                                        <p class="text-sm font-normal text-gray-500">Laporan sedang ditindaklanjuti oleh dinas terkait.</p>
                                    @else
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-[17px] ring-4 ring-white">
                                            <span class="material-symbols-outlined text-gray-400 text-sm">cached</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-semibold text-gray-400">Sedang Diproses</h3>
                                        <p class="text-sm font-normal text-gray-400">Menunggu tindak lanjut dinas terkait.</p>
                                    @endif
                                </li>
                                <li class="ml-6">
                                    @if ($status === 'selesai')
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-green-500 rounded-full -left-[17px] ring-4 ring-white shadow-lg shadow-green-200">
                                            <span class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-bold text-green-600">Selesai</h3>
                                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $complaint->updated_at->translatedFormat('d F Y, H:i') }} WIB</time>
                                        <p class="text-sm font-normal text-gray-500">Laporan telah selesai ditangani. Terima kasih atas partisipasi Anda.</p>
                                    @else
                                        <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-[17px] ring-4 ring-white">
                                            <span class="material-symbols-outlined text-gray-400 text-sm">flag</span>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-semibold text-gray-400">Selesai</h3>
                                        <p class="text-sm font-normal text-gray-400">Menunggu penyelesaian tindak lanjut.</p>
                                    @endif
                                </li>
                            </ol>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex gap-4 items-start">
                            <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                            <div>
                                <h4 class="font-bold text-sm text-[#0d141b] mb-1">Estimasi Pengerjaan</h4>
                                <p class="text-sm text-slate-600">Berdasarkan kategori laporan, estimasi penyelesaian adalah 3-5 hari kerja.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Details -->
                    <div class="lg:col-span-8 flex flex-col gap-6">
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                                <h3 class="font-bold text-lg text-[#0d141b]">Detail Laporan</h3>
                                <span class="bg-white border border-gray-200 text-gray-600 text-xs font-bold px-2 py-1 rounded">Publik</span>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 mb-8">
                                    <div>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori</p>
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-slate-500 text-lg">engineering</span>
                                            <p class="font-medium text-[#0d141b]">{{ $complaint->kategori }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Dibuat</p>
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-slate-500 text-lg">calendar_today</span>
                                            <p class="font-medium text-[#0d141b]">{{ $complaint->created_at->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Judul Laporan</p>
                                        <p class="font-bold text-lg text-[#0d141b]">{{ $complaint->judul }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Lengkap</p>
                                        <p class="text-base text-slate-600 leading-relaxed">{{ $complaint->deskripsi }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Lampiran Foto</p>
                                    @if ($complaint->foto_path)
                                        <div class="flex flex-wrap gap-4">
                                            <a href="{{ asset('storage/'.$complaint->foto_path) }}" target="_blank" class="w-24 h-24 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden cursor-pointer hover:opacity-80 transition-opacity block bg-cover bg-center" style="background-image: url('{{ asset('storage/'.$complaint->foto_path) }}');"></a>
                                        </div>
                                    @else
                                        <p class="text-sm text-slate-400">Tidak ada foto lampiran.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($complaint->admin_response)
                            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden border-l-4 border-l-primary">
                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined">support_agent</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-[#0d141b]">Tanggapan Admin</h4>
                                            <p class="text-xs text-slate-500">Dinas Terkait • {{ $complaint->updated_at->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="bg-slate-50 rounded-lg p-4 text-slate-700 text-sm leading-relaxed border border-slate-100">
                                        "{{ $complaint->admin_response }}"
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @elseif ($notFound)
                <div class="flex-1 flex flex-col items-center justify-center py-20 px-4 text-center">
                    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-red-400">search_off</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tiket tidak ditemukan</h3>
                    <p class="text-gray-500 max-w-md">Nomor tiket <span class="font-mono font-bold">{{ $ticket }}</span> tidak terdaftar di sistem. Periksa kembali nomor tiket Anda.</p>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center py-20 px-4 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-slate-400">inbox</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada data ditampilkan</h3>
                    <p class="text-gray-500 max-w-md">Silakan masukkan nomor tiket pada kolom pencarian di atas untuk melihat status pengaduan Anda.</p>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
