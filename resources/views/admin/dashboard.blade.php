@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<!-- Page Heading -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Dashboard</h2>
    <div class="flex items-center gap-3 text-sm text-slate-500">
        <span class="material-symbols-outlined">notifications</span>
        <span class="font-medium text-slate-700">{{ auth()->user()->name }}</span>
        <span class="text-xs bg-primary/10 text-primary px-2 py-0.5 rounded-full font-bold">Super Admin</span>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
    @php
        $cards = [
            ['label' => 'Total Pengaduan', 'value' => $total, 'icon' => 'folder_open', 'color' => 'text-primary bg-blue-50'],
            ['label' => 'Pending', 'value' => $pending, 'icon' => 'hourglass_empty', 'color' => 'text-orange-500 bg-orange-50'],
            ['label' => 'Sedang Diproses', 'value' => $proses, 'icon' => 'sync', 'color' => 'text-blue-500 bg-blue-50'],
            ['label' => 'Selesai', 'value' => $selesai, 'icon' => 'check_circle', 'color' => 'text-emerald-600 bg-emerald-50'],
        ];
    @endphp
    @foreach ($cards as $card)
        <div class="flex flex-col gap-4 rounded-xl p-6 bg-white shadow-sm border border-slate-100">
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1">
                    <p class="text-slate-500 text-sm font-medium">{{ $card['label'] }}</p>
                    <p class="text-[#0d141b] text-3xl font-bold tracking-tight">{{ number_format($card['value']) }}</p>
                </div>
                <div class="p-2 rounded-lg {{ $card['color'] }}">
                    <span class="material-symbols-outlined">{{ $card['icon'] }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="flex flex-col gap-6 rounded-xl p-6 bg-white shadow-sm border border-slate-100">
        <div>
            <h3 class="text-[#0d141b] text-lg font-bold">Pengaduan per Kategori</h3>
            <p class="text-slate-500 text-sm">Last 30 days</p>
        </div>
        <div class="grid h-64 grid-cols-6 gap-2 sm:gap-4 items-end justify-items-center pt-4">
            @php
                $short = ['Jalan Rusak' => 'Infra', 'Kebersihan' => 'Layanan', 'Lampu Jalan' => 'Aman', 'Saluran Air' => 'Sehat', 'Fasilitas Umum' => 'Didik', 'Lainnya' => 'Lainnya'];
            @endphp
            @foreach ($perKategori as $nama => $jumlah)
                @php $pct = round($jumlah / $maxKategori * 100); @endphp
                <div class="group w-full flex flex-col items-center gap-2 h-full justify-end">
                    <div class="w-full max-w-[40px] bg-primary/20 rounded-t-sm group-hover:bg-primary transition-all relative" style="height: {{ max($pct, 4) }}%;">
                        <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs px-2 py-1 rounded pointer-events-none transition-opacity">{{ $jumlah }}</div>
                    </div>
                    <p class="text-slate-500 text-[11px] sm:text-xs font-semibold text-center truncate w-full">{{ $short[$nama] ?? $nama }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col gap-6 rounded-xl p-6 bg-white shadow-sm border border-slate-100">
        <div>
            <h3 class="text-[#0d141b] text-lg font-bold">Trend Pengaduan 7 Hari</h3>
            <p class="text-slate-500 text-sm">Total Volume</p>
        </div>
        @php
            $max = max(1, max($trend));
            $points = [];
            foreach ($trend as $i => $v) {
                $x = $i * (100 / 6);
                $y = 45 - ($v / $max * 40);
                $points[] = [$x, $y];
            }
            $line = 'M'.implode(' L', array_map(fn ($p) => $p[0].' '.$p[1], $points));
            $area = $line.' V50 H0 Z';
        @endphp
        <div class="flex flex-col h-64 justify-between pt-4">
            <div class="relative w-full h-full">
                <svg class="w-full h-full overflow-visible" preserveaspectratio="none" viewbox="0 0 100 50">
                    <defs>
                        <lineargradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#137fec" stop-opacity="0.2"></stop>
                            <stop offset="100%" stop-color="#137fec" stop-opacity="0"></stop>
                        </lineargradient>
                    </defs>
                    <path d="{{ $area }}" fill="url(#chartGradient)"></path>
                    <path d="{{ $line }}" fill="none" stroke="#137fec" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                    @foreach ($points as $p)
                        <circle cx="{{ $p[0] }}" cy="{{ $p[1] }}" fill="white" r="1.5" stroke="#137fec" stroke-width="1"></circle>
                    @endforeach
                </svg>
            </div>
            <div class="flex justify-between text-xs text-slate-400 mt-4 font-medium uppercase tracking-wider">
                @foreach ($labels as $label)
                    <span>{{ $label }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Recent Complaints Table -->
<div class="flex flex-col gap-4 rounded-xl bg-white shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
        <h3 class="text-[#0d141b] text-lg font-bold leading-tight">Recent Complaints</h3>
        <a href="{{ route('admin.pengaduan.index') }}" class="text-primary font-bold text-sm hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Ticket</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse ($recent as $item)
                @php
                    $badge = [
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'proses' => 'bg-blue-100 text-blue-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        'ditolak' => 'bg-red-100 text-red-700',
                    ][$item->status];
                    $label = ['pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'][$item->status];
                @endphp
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">#{{ $item->ticket_number }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $item->kategori }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $badge }}">{{ $label }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $item->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.pengaduan.show', ['ticket' => $item->ticket_number]) }}" class="text-primary hover:text-blue-700 font-medium text-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">Belum ada pengaduan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
