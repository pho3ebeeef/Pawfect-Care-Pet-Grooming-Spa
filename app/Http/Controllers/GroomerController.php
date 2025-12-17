<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use App\Models\Groomer;

class GroomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Groomer dashboard
    public function index(): View
    {
        $userId = Auth::id();

        // Find the groomer record linked to this user
        $groomer = Groomer::where('user_id', $userId)->firstOrFail();

        // Fetch appointments assigned to this groomer (using groomer->id)
        $appointments = Appointment::where('groomer_id', $groomer->id)
            ->with(['client', 'pet', 'service'])
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('groomer.dashboard', compact('appointments'));
    }

    // Update appointment status
    public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
    {
        $groomer = Groomer::where('user_id', Auth::id())->firstOrFail();

        // Ensure this appointment belongs to the logged-in groomer
        if ($appointment->groomer_id !== $groomer->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:pending,in-progress,completed,no-show',
        ]);

        // Explicitly set and save
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('groomer.dashboard')
                         ->with('success', 'Status updated successfully.');
    }

    // Update appointment notes
    public function updateNotes(Request $request, Appointment $appointment): RedirectResponse
    {
        $groomer = Groomer::where('user_id', Auth::id())->firstOrFail();

        if ($appointment->groomer_id !== $groomer->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        // Save notes to the correct column (admin_notes)
        $appointment->admin_notes = $request->notes;
        $appointment->save();

        return redirect()->route('groomer.dashboard')
                         ->with('success', 'Notes updated successfully.');
    }
}