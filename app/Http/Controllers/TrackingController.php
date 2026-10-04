<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackingController extends Controller
{
    public function index(Request $request): View
    {
        $ticket = trim((string) $request->query('ticket', ''));
        $complaint = null;
        $notFound = false;

        if ($ticket !== '') {
            $complaint = Complaint::query()
                ->where('ticket_number', $ticket)
                ->first();

            $notFound = $complaint === null;
        }

        return view('tracking.index', compact('ticket', 'complaint', 'notFound'));
    }

    public function show(string $ticket): View
    {
        $complaint = Complaint::query()
            ->where('ticket_number', $ticket)
            ->firstOrFail();

        return view('tracking.index', [
            'ticket' => $ticket,
            'complaint' => $complaint,
            'notFound' => false,
        ]);
    }
}
