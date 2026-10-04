<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $total = Complaint::query()->count();
        $diproses = Complaint::query()->whereIn('status', ['pending', 'proses'])->count();
        $selesai = Complaint::query()->where('status', 'selesai')->count();

        $latestResolved = Complaint::query()
            ->where('status', 'selesai')
            ->latest()
            ->take(3)
            ->get();

        return view('home.index', compact('total', 'diproses', 'selesai', 'latestResolved'));
    }
}
