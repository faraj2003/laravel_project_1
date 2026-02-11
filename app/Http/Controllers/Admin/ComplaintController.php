<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // List all complaints from all students
    public function index()
    {
        $complaints = Complaint::with('user')->latest()->get();
        return view('admin.complaints.index', compact('complaints'));
    }

    // Mark as Resolved
    public function markResolved(Complaint $complaint)
    {
        $complaint->update(['status' => 'resolved']);
        return back()->with('status', 'Complaint marked as resolved.');
    }
}