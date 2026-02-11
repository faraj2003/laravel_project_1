<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // List my complaints
    public function index()
    {
        $complaints = Auth::user()->complaints()->latest()->get();
        return view('complaints.index', compact('complaints'));
    }

    // Show the form
    public function create()
    {
        return view('complaints.create');
    }

    // Store the complaint
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('complaints.index')->with('status', 'Complaint submitted successfully!');
    }
}