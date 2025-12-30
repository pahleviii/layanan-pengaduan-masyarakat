<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:5120'
        ]);

        $ticketNumber = 'TKT-' . date('Y') . '-' . str_pad(\App\Models\Complaint::count() + 1, 3, '0', STR_PAD_LEFT);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->extension();
            $file->move(public_path('uploads/complaints'), $filename);
            $photoPath = 'uploads/complaints/' . $filename;
        }

        $complaint = Complaint::create([
            'ticket_number' => $ticketNumber,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan berhasil dikirim',
            'data' => [
                'ticket_number' => $ticketNumber,
                'complaint' => $complaint
            ]
        ], 201);
    }

    public function getByTicket($ticketNumber)
    {
        $complaint = Complaint::with('category')
            ->where('ticket_number', $ticketNumber)
            ->first();

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Pengaduan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $complaint
        ]);
    }

    public function getResolved(Request $request)
    {
        $query = Complaint::with('category')
            ->where('status', 'resolved');

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('ticket_number', 'like', '%' . $request->search . '%');
            });
        }

        $complaints = $query->latest()->paginate(6);

        return response()->json([
            'success' => true,
            'data' => $complaints
        ]);
    }

    public function getStatistics()
    {
        $stats = [
            'total' => Complaint::count(),
            'pending' => Complaint::where('status', 'pending')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
    // Get all complaints (for admin)
public function index(Request $request)
{
    $query = Complaint::with('category');

    // Filter by status
    if ($request->has('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    // Filter by category
    if ($request->has('category_id') && $request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    // Search by ticket number, title, or name
    if ($request->has('search') && $request->search) {
        $query->where(function($q) use ($request) {
            $q->where('ticket_number', 'like', '%' . $request->search . '%')
              ->orWhere('title', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }

    // Order by newest
    $complaints = $query->latest()->paginate(10);

    return response()->json([
        'success' => true,
        'data' => $complaints
    ]);
}

// Get single complaint detail (for admin)
public function show($id)
{
    $complaint = Complaint::with('category')->findOrFail($id);

    return response()->json([
        'success' => true,
        'data' => $complaint
    ]);
}

// Update complaint status & admin note
public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,in_progress,resolved,rejected',
        'admin_note' => 'nullable|string'
    ]);

    $complaint = Complaint::findOrFail($id);
    
    $complaint->update([
        'status' => $request->status,
        'admin_note' => $request->admin_note
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Status pengaduan berhasil diupdate',
        'data' => $complaint
    ]);
}
/**
 * Get resolved complaints (public)
 */
public function resolved(Request $request)
{
    $query = Complaint::with(['category'])
        ->where('status', 'resolved');
    
    // Search filter
    if ($request->has('search') && $request->search) {
        $query->where(function($q) use ($request) {
            $q->where('ticket_number', 'like', '%' . $request->search . '%')
              ->orWhere('title', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }
    
    // Category filter
    if ($request->has('category_id') && $request->category_id) {
        $query->where('category_id', $request->category_id);
    }
    
    // Date range filter
    if ($request->has('date_range') && $request->date_range) {
        $now = now();
        switch ($request->date_range) {
            case '7days':
                $query->where('updated_at', '>=', $now->subDays(7));
                break;
            case '30days':
                $query->where('updated_at', '>=', $now->subDays(30));
                break;
            case '3months':
                $query->where('updated_at', '>=', $now->subMonths(3));
                break;
        }
    }
    
    // Order by most recent
    $query->orderBy('updated_at', 'desc');
    
    $complaints = $query->paginate(9); // 9 items per page (3x3 grid)
    
    return response()->json([
        'success' => true,
        'data' => $complaints
    ]);
}

}
