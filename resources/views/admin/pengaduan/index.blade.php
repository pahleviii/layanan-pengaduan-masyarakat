@extends('layouts.admin')

@section('title', 'Kelola Pengaduan - Admin Panel')

@section('content')
<!-- Page Heading -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola Pengaduan</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola dan tindak lanjuti laporan dari masyarakat.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
            <span class="material-symbols-outlined text-[18px]">refresh</span>
            <span>Refresh</span>
        </a>
        <a href="{{ route('lapor') }}" target="_blank" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm shadow-primary/30 hover:bg-blue-600 transition-colors">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Buat Laporan</span>
        </a>
    </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @php
        $stats = [
            ['label' => 'Total Pengaduan', 'value' => $counts['semua'], 'icon' => 'folder_open', 'color' => 'text-blue-600 bg-blue-50'],
            ['label' => 'Pending', 'value' => $counts['pending'], 'icon' => 'pending', 'color' => 'text-yellow-600 bg-yellow-50'],
            ['label' => 'In Progress', 'value' => $counts['proses'], 'icon' => 'autorenew', 'color' => 'text-purple-600 bg-purple-50'],
            ['label' => 'Selesai', 'value' => $counts['selesai'], 'icon' => 'check_circle', 'color' => 'text-green-600 bg-green-50'],
        ];
    @endphp
    @foreach ($stats as $stat)
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-3 text-slate-500">
                <span class="material-symbols-outlined rounded-full p-2 {{ $stat['color'] }}">{{ $stat['icon'] }}</span>
                <span class="text-sm font-medium">{{ $stat['label'] }}</span>
            </div>
            <p class="mt-3 text-2xl font-bold text-slate-900">{{ number_format($stat['value']) }}</p>
        </div>
    @endforeach
</div>

<!-- Main Content Card -->
<div class="flex flex-col rounded-xl border border-slate-200 bg-white shadow-sm">
    <form id="filter-form" action="{{ route('admin.pengaduan.index') }}" method="GET">
        <div class="flex flex-col border-b border-slate-200 p-4">
            <div class="mb-4 flex flex-wrap gap-2 sm:gap-6">
                @php
                    $tabs = ['semua' => 'Semua', 'pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'];
                @endphp
                @foreach ($tabs as $key => $label)
                    @if ($status === $key)
                        <span class="relative pb-2 text-sm font-semibold text-primary after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-full after:bg-primary">
                            {{ $label }} <span class="ml-1 rounded-full bg-primary/10 px-2 py-0.5 text-xs text-primary">{{ $counts[$key] }}</span>
                        </span>
                    @else
                        <a href="{{ route('admin.pengaduan.index', ['status' => $key, 'q' => $search, 'kategori' => $kategori]) }}" class="relative pb-2 text-sm font-medium text-slate-500 hover:text-slate-800">
                            {{ $label }} <span class="ml-1 rounded-full bg-slate-100 px-2 py-0.5 text-xs text-slate-500">{{ $counts[$key] }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
            <input type="hidden" name="status" value="{{ $status }}"/>
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-1 flex-col gap-3 sm:flex-row">
                    <div class="relative w-full sm:max-w-xs">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="material-symbols-outlined text-slate-400 text-[20px]">search</span>
                        </div>
                        <input name="q" value="{{ $search }}" class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3 text-sm placeholder-slate-400 focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Cari tiket, nama, atau judul..." type="text"/>
                    </div>
                    <div class="relative w-full sm:w-48">
                        <select name="kategori" onchange="document.getElementById('filter-form').submit()" class="block w-full appearance-none rounded-lg border border-slate-300 bg-white py-2.5 pl-3 pr-10 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ $kategori === $cat ? 'selected' : '' }}>{{ $cat === 'Semua' ? 'Semua Kategori' : $cat }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>
                    <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-slate-700">Filter</button>
                    @if ($search !== '' || $kategori !== 'Semua')
                        <a href="{{ route('admin.pengaduan.index', ['status' => $status]) }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-slate-800">Reset</a>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <form id="bulk-form" action="{{ route('admin.pengaduan.bulk-destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex items-center justify-end px-4 pt-3">
            <button type="submit" onclick="return confirm('Hapus pengaduan yang dipilih? Tindakan ini tidak dapat dibatalkan.')" class="flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-100">
                <span class="material-symbols-outlined text-[18px]">delete</span>
                <span>Bulk Delete</span>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] table-auto text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="w-10 px-4 py-3">
                        <input id="check-all" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" type="checkbox"/>
                    </th>
                    <th class="px-4 py-3 font-semibold">No. Tiket</th>
                    <th class="px-4 py-3 font-semibold">Pelapor</th>
                    <th class="px-4 py-3 font-semibold">Kategori</th>
                    <th class="px-4 py-3 font-semibold">Judul Laporan</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                @forelse ($complaints as $item)
                    @php
                        $badge = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'proses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                        ][$item->status];
                        $label = ['pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'][$item->status];
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3">
                            <input name="ids[]" value="{{ $item->id }}" class="row-check h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" type="checkbox"/>
                        </td>
                        <td class="px-4 py-3 font-medium text-primary">
                            <a href="{{ route('admin.pengaduan.show', ['ticket' => $item->ticket_number]) }}" class="hover:underline">#{{ $item->ticket_number }}</a>
                        </td>
                        <td class="px-4 py-3 text-slate-900">{{ $item->nama }}</td>
                        <td class="px-4 py-3">{{ $item->kategori }}</td>
                        <td class="px-4 py-3 truncate max-w-[200px]">{{ $item->judul }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $badge }}">{{ $label }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.pengaduan.show', ['ticket' => $item->ticket_number]) }}" title="Lihat" class="rounded p-1 text-slate-400 hover:bg-slate-100 hover:text-blue-600">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.pengaduan.show', ['ticket' => $item->ticket_number]) }}" title="Ubah" class="rounded p-1 text-slate-400 hover:bg-slate-100 hover:text-green-600">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <button type="submit" form="delete-{{ $item->id }}" title="Hapus" class="rounded p-1 text-slate-400 hover:bg-slate-100 hover:text-red-600" onclick="return confirm('Hapus pengaduan #{{ $item->ticket_number }}?')">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-4 py-10 text-center text-sm text-slate-400">Tidak ada pengaduan yang cocok dengan filter.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </form>
    @foreach ($complaints as $item)
        <form id="delete-{{ $item->id }}" action="{{ route('admin.pengaduan.destroy', ['ticket' => $item->ticket_number]) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    <div class="flex items-center justify-between border-t border-slate-200 p-4">
        <div class="text-sm text-slate-500">
            Showing <span class="font-semibold text-slate-900">{{ $complaints->firstItem() ?? 0 }}-{{ $complaints->lastItem() ?? 0 }}</span> of <span class="font-semibold text-slate-900">{{ $complaints->total() }}</span> results
        </div>
        <div class="flex gap-2">
            @if ($complaints->onFirstPage())
                <span class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-300">
                    <span class="material-symbols-outlined mr-1 text-[16px]">chevron_left</span> Previous
                </span>
            @else
                <a href="{{ $complaints->previousPageUrl() }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    <span class="material-symbols-outlined mr-1 text-[16px]">chevron_left</span> Previous
                </a>
            @endif
            @if ($complaints->hasMorePages())
                <a href="{{ $complaints->nextPageUrl() }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Next <span class="material-symbols-outlined ml-1 text-[16px]">chevron_right</span>
                </a>
            @else
                <span class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-300">
                    Next <span class="material-symbols-outlined ml-1 text-[16px]">chevron_right</span>
                </span>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const checkAll = document.getElementById('check-all');
    checkAll?.addEventListener('change', () => {
        document.querySelectorAll('.row-check').forEach(c => { c.checked = checkAll.checked; });
    });
</script>
@endpush
