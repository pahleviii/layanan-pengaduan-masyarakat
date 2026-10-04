<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    /**
     * @var list<string>
     */
    public const CATEGORIES = [
        'Jalan Rusak',
        'Kebersihan',
        'Lampu Jalan',
        'Saluran Air',
        'Fasilitas Umum',
        'Lainnya',
    ];

    public function create(): View
    {
        return view('complaints.create', [
            'categories' => self::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telepon' => ['required', 'string', 'max:30'],
            'kategori' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:2000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            /** @var UploadedFile $foto */
            $foto = $request->file('foto');
            $fotoPath = $foto->store('pengaduan', 'public');
        }

        $complaint = Complaint::query()->create([
            'ticket_number' => $this->generateTicketNumber(),
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'telepon' => $validated['telepon'],
            'kategori' => $validated['kategori'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'foto_path' => $fotoPath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('lapor.sukses', ['ticket' => $complaint->ticket_number])
            ->with('ticket_number', $complaint->ticket_number);
    }

    public function success(string $ticket): View
    {
        $complaint = Complaint::query()
            ->where('ticket_number', $ticket)
            ->firstOrFail();

        return view('complaints.success', compact('complaint'));
    }

    private function generateTicketNumber(): string
    {
        $date = now()->format('Ymd');

        do {
            $ticket = 'ADU-'.$date.'-'.str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (Complaint::query()->where('ticket_number', $ticket)->exists());

        return $ticket;
    }
}
