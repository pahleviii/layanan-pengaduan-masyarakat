<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $total = Complaint::query()->count();
        $pending = Complaint::query()->where('status', 'pending')->count();
        $proses = Complaint::query()->where('status', 'proses')->count();
        $selesai = Complaint::query()->where('status', 'selesai')->count();

        $categories = ['Jalan Rusak', 'Kebersihan', 'Lampu Jalan', 'Saluran Air', 'Fasilitas Umum', 'Lainnya'];
        $perKategori = [];
        foreach ($categories as $kategori) {
            $perKategori[$kategori] = Complaint::query()->where('kategori', $kategori)->count();
        }
        $maxKategori = max(1, max($perKategori));

        $trend = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = strtoupper($date->isoFormat('ddd'));
            $trend[] = Complaint::query()->whereDate('created_at', $date->toDateString())->count();
        }

        $recent = Complaint::query()->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'total', 'pending', 'proses', 'selesai',
            'perKategori', 'maxKategori', 'trend', 'labels', 'recent'
        ));
    }
}
