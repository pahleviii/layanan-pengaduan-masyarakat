<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    /**
     * @var list<string>
     */
    public const STATUSES = ['pending', 'proses', 'selesai', 'ditolak'];

    public function index(Request $request): View
    {
        $status = (string) $request->query('status', 'semua');
        $search = trim((string) $request->query('q', ''));
        $kategori = (string) $request->query('kategori', 'Semua');

        if (! in_array($status, [...self::STATUSES, 'semua'], true)) {
            $status = 'semua';
        }

        $counts = ['semua' => Complaint::query()->count()];
        foreach (self::STATUSES as $s) {
            $counts[$s] = Complaint::query()->where('status', $s)->count();
        }

        $complaints = Complaint::query()
            ->when($status !== 'semua', fn ($q) => $q->where('status', $status))
            ->when($search !== '', fn ($q) => $q->where(function ($inner) use ($search) {
                $inner->where('ticket_number', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%");
            }))
            ->when($kategori !== 'Semua', fn ($q) => $q->where('kategori', $kategori))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengaduan.index', [
            'complaints' => $complaints,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'kategori' => $kategori,
            'categories' => ['Semua', 'Jalan Rusak', 'Kebersihan', 'Lampu Jalan', 'Saluran Air', 'Fasilitas Umum', 'Lainnya'],
        ]);
    }

    public function show(string $ticket): View
    {
        $complaint = Complaint::query()->where('ticket_number', $ticket)->firstOrFail();

        return view('admin.pengaduan.show', compact('complaint'));
    }

    public function update(Request $request, string $ticket): RedirectResponse
    {
        $complaint = Complaint::query()->where('ticket_number', $ticket)->firstOrFail();

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:'.implode(',', self::STATUSES)],
            'admin_response' => ['nullable', 'string', 'max:2000'],
        ]);

        $complaint->update($validated);

        return redirect()
            ->route('admin.pengaduan.show', ['ticket' => $complaint->ticket_number])
            ->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(string $ticket): RedirectResponse
    {
        $complaint = Complaint::query()->where('ticket_number', $ticket)->firstOrFail();
        $complaint->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', "Pengaduan #{$ticket} telah dihapus.");
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:complaints,id'],
        ]);

        $count = Complaint::query()->whereIn('id', $validated['ids'])->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', "{$count} pengaduan telah dihapus.");
    }
}
