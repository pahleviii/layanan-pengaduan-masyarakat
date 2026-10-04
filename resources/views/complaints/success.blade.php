@extends('layouts.app')

@section('title', 'Pengaduan Terkirim - Sistem Pengaduan Masyarakat')

@section('content')
<main class="py-16 px-4 sm:px-6">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-3xl text-green-600">check_circle</span>
        </div>
        <h3 class="text-2xl font-bold text-[#0d141b] mb-2">Pengaduan Terkirim!</h3>
        <p class="text-slate-500 mb-6">Laporan Anda telah berhasil kami terima dan akan segera diproses. Simpan nomor tiket ini untuk melacak status laporan.</p>
        <div class="bg-slate-100 rounded-lg p-4 mb-6 border border-slate-200 flex items-center justify-between">
            <div class="text-left">
                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Nomor Tiket</p>
                <p class="text-lg font-mono font-bold text-primary" id="ticket-number">{{ $complaint->ticket_number }}</p>
            </div>
            <button onclick="navigator.clipboard.writeText(document.getElementById('ticket-number').innerText); this.querySelector('.material-symbols-outlined').innerText='check'; setTimeout(()=>this.querySelector('.material-symbols-outlined').innerText='content_copy',1500);" class="p-2 hover:bg-white rounded-md transition-colors text-slate-500 hover:text-primary" title="Salin Nomor Tiket" type="button">
                <span class="material-symbols-outlined">content_copy</span>
            </button>
        </div>
        <div class="text-left text-sm text-slate-600 bg-slate-50 rounded-lg p-4 mb-6 space-y-1">
            <p><span class="font-bold">Judul:</span> {{ $complaint->judul }}</p>
            <p><span class="font-bold">Kategori:</span> {{ $complaint->kategori }}</p>
            <p><span class="font-bold">Status:</span> Menunggu verifikasi</p>
        </div>
        <a href="{{ route('home') }}" class="block w-full py-3 px-4 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg transition-colors text-center">
            Kembali ke Beranda
        </a>
    </div>
</main>
@endsection
