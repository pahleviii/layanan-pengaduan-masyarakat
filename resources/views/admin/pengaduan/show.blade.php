@extends('layouts.admin')

@section('title', 'Detail Pengaduan #'.$complaint->ticket_number.' - Admin Panel')

@section('content')
<!-- Breadcrumbs -->
<nav class="flex text-sm font-medium text-slate-500">
    <ol class="flex flex-wrap items-center gap-2">
        <li><a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><span class="material-symbols-outlined text-base align-middle">chevron_right</span></li>
        <li><a class="hover:text-primary transition-colors" href="{{ route('admin.pengaduan.index') }}">Kelola Pengaduan</a></li>
        <li><span class="material-symbols-outlined text-base align-middle">chevron_right</span></li>
        <li class="text-slate-900 font-semibold">Detail Pengaduan #{{ $complaint->ticket_number }}</li>
    </ol>
</nav>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <h1 class="text-3xl font-bold tracking-tight text-slate-900">Detail Pengaduan</h1>
    <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors w-fit">
        <span class="material-symbols-outlined text-[20px]">print</span>
        Cetak
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    <!-- LEFT COLUMN -->
    <div class="lg:col-span-7 xl:col-span-8 flex flex-col gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm text-slate-500 mb-1">Nomor Tiket</p>
                    <div class="flex items-center gap-3 flex-wrap">
                        <h2 class="text-2xl font-bold text-primary">#{{ $complaint->ticket_number }}</h2>
                        @php
                            $badge = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'proses' => 'bg-blue-100 text-blue-800',
                                'selesai' => 'bg-green-100 text-green-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                            ][$complaint->status];
                            $label = ['pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'][$complaint->status];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">{{ $label }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-500 mb-1">Tanggal Dibuat</p>
                    <p class="text-base font-medium text-slate-900">{{ $complaint->created_at->translatedFormat('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Lampiran Foto</h3>
                @if ($complaint->foto_path)
                    <a href="{{ asset('storage/'.$complaint->foto_path) }}" target="_blank" class="relative group cursor-pointer overflow-hidden rounded-lg bg-slate-100 border border-slate-200 aspect-video max-h-[400px] block bg-cover bg-center" style="background-image: url('{{ asset('storage/'.$complaint->foto_path) }}');">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full flex items-center gap-2 transition-opacity shadow-lg">
                                <span class="material-symbols-outlined text-slate-900">zoom_in</span>
                                <span class="text-sm font-medium text-slate-900">Perbesar Foto</span>
                            </div>
                        </div>
                    </a>
                @else
                    <p class="text-sm text-slate-400 bg-slate-50 border border-slate-200 rounded-lg p-6 text-center">Tidak ada foto lampiran.</p>
                @endif
            </div>

            <div class="p-6 grid grid-cols-1 gap-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">person</span>
                        Detail Pelapor
                    </h3>
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-100 flex flex-col gap-4">
                        @php
                            $kontak = [['Nama', $complaint->nama], ['Email', $complaint->email ?? '-'], ['Telepon', $complaint->telepon ?? '-']];
                        @endphp
                        @foreach ($kontak as $i => [$k, $v])
                            @if ($i > 0)<div class="h-px bg-slate-200 w-full"></div>@endif
                            <div class="grid grid-cols-[100px_1fr] gap-4 items-center">
                                <span class="text-sm text-slate-500">{{ $k }}</span>
                                <div class="flex items-center gap-2 font-medium text-slate-900">
                                    {{ $v }}
                                    <button type="button" onclick="navigator.clipboard.writeText(@js($v))" class="text-slate-400 hover:text-primary transition-colors" title="Salin">
                                        <span class="material-symbols-outlined text-[16px]">content_copy</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-2">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">description</span>
                        Isi Pengaduan
                    </h3>
                    <div class="flex flex-col gap-4">
                        <div>
                            <span class="text-xs font-bold tracking-wider text-slate-500 uppercase mb-1 block">Kategori</span>
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-700 rounded-md text-sm font-medium border border-blue-100">
                                <span class="material-symbols-outlined text-[18px]">sell</span>
                                {{ $complaint->kategori }}
                            </div>
                        </div>
                        <div>
                            <span class="text-xs font-bold tracking-wider text-slate-500 uppercase mb-1 block">Judul</span>
                            <p class="text-lg font-medium text-slate-900">{{ $complaint->judul }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold tracking-wider text-slate-500 uppercase mb-1 block">Deskripsi Lengkap</span>
                            <div class="text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100">
                                <p>{{ $complaint->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="lg:col-span-5 xl:col-span-4 flex flex-col gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Tindak Lanjut</h3>
            <form action="{{ route('admin.pengaduan.update', ['ticket' => $complaint->ticket_number]) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-slate-700" for="status">Update Status</label>
                    <div class="relative">
                        <select name="status" id="status" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-slate-900 appearance-none cursor-pointer">
                            @foreach (['pending' => 'Pending', 'proses' => 'Sedang Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'] as $val => $lbl)
                                <option value="{{ $val }}" {{ $complaint->status === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">flag</span>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none text-[20px]">expand_more</span>
                    </div>
                    @error('status')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-slate-700" for="admin_response">Catatan / Tanggapan Admin</label>
                    <textarea name="admin_response" id="admin_response" rows="4" placeholder="Tulis tanggapan untuk pelapor atau catatan internal..." class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-slate-900 placeholder-slate-400 text-sm leading-relaxed">{{ old('admin_response', $complaint->admin_response) }}</textarea>
                    <p class="text-xs text-slate-400">Tanggapan tampil ke pelapor di halaman Lacak Status.</p>
                    @error('admin_response')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="mt-2 w-full flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm shadow-blue-500/30 transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Perubahan
                </button>
            </form>
            <div class="mt-8 pt-6 border-t border-slate-200">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Riwayat Aktivitas</h4>
                <div class="relative pl-4 border-l-2 border-slate-200 space-y-6">
                    <div class="relative">
                        <div class="absolute -left-[21px] top-1 h-3 w-3 rounded-full bg-slate-300 border-2 border-white"></div>
                        <p class="text-xs text-slate-500 font-mono mb-1">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
                        <p class="text-sm text-slate-900 font-medium">Pengaduan Masuk</p>
                        <p class="text-xs text-slate-500">Sistem</p>
                    </div>
                    @if ($complaint->updated_at->ne($complaint->created_at))
                        <div class="relative">
                            <div class="absolute -left-[21px] top-1 h-3 w-3 rounded-full bg-primary border-2 border-white"></div>
                            <p class="text-xs text-slate-500 font-mono mb-1">{{ $complaint->updated_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm text-slate-900 font-medium">Status: {{ ['pending' => 'Pending', 'proses' => 'Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'][$complaint->status] }}</p>
                            <p class="text-xs text-slate-500">{{ auth()->user()->name }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-red-50 rounded-xl border border-red-200 p-6">
            <h3 class="text-sm font-bold text-red-700 uppercase tracking-wider mb-2">Danger Zone</h3>
            <p class="text-sm text-red-600/80 mb-4">Menghapus pengaduan ini tidak dapat dibatalkan. Pastikan Anda yakin.</p>
            <form action="{{ route('admin.pengaduan.destroy', ['ticket' => $complaint->ticket_number]) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini secara permanen?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white text-red-600 border border-red-200 font-medium py-2 px-4 rounded-lg hover:bg-red-50 hover:border-red-300 transition-colors text-sm">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Hapus Pengaduan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
