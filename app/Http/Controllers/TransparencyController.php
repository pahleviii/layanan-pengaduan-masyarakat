<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransparencyController extends Controller
{
    /**
     * @var list<string>
     */
    public const FILTERS = [
        'Semua',
        'Jalan Rusak',
        'Kebersihan',
        'Lampu Jalan',
        'Saluran Air',
        'Fasilitas Umum',
        'Lainnya',
    ];

    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $kategori = (string) $request->query('kategori', 'Semua');

        $complaints = Complaint::query()
            ->where('status', 'selesai')
            ->when($query !== '', function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {
                    $inner->where('ticket_number', 'like', "%{$query}%")
                        ->orWhere('judul', 'like', "%{$query}%");
                });
            })
            ->when($kategori !== '' && $kategori !== 'Semua', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('transparency.index', [
            'complaints' => $complaints,
            'query' => $query,
            'kategori' => $kategori,
            'filters' => self::FILTERS,
        ]);
    }
}
