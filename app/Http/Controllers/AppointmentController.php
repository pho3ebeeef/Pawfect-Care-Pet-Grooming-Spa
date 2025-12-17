<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Groomer;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function dashboard(): View
    {
        $userId = auth()->id();
        $client = Client::where('user_id', $userId)->firstOrFail();

        $upcomingAppointments = Appointment::where('client_id', $client->id)
            ->where('scheduled_at', '>=', Carbon::now())
            ->orderBy('scheduled_at', 'asc')
            ->with(['service', 'pet'])
            ->get();

        $pastAppointments = Appointment::where('client_id', $client->id)
            ->where('scheduled_at', '<', Carbon::now())
            ->orderBy('scheduled_at', 'desc')
            ->with(['service', 'pet'])
            ->get();

        $services = Service::all();

        return view('client.dashboard', compact('upcomingAppointments', 'pastAppointments', 'services'));
    }

    public function store(Request $request): RedirectResponse
    {
        \Log::info('STORE METHOD HIT', $request->all());

        $validated = $request->validate([
            'pet_name'      => 'required|string|max:255',
            'species'       => 'required|string|max:255',
            'breed'         => 'nullable|string|max:255',
            'service_id'    => 'required|integer|exists:services,id',
            'scheduled_at'  => 'required|date',
            'client_notes'  => 'nullable|string|max:1000',
        ]);

        $client = Client::where('user_id', auth()->id())->firstOrFail();

        $pet = Pet::create([
            'name'      => $validated['pet_name'],
            'species'   => $validated['species'],
            'breed'     => $validated['breed'],
            'client_id' => $client->id,
        ]);

        Appointment::create([
            'client_id'    => $client->id,
            'pet_id'       => $pet->id,
            'pet_name'     => $validated['pet_name'],
            'species'      => $validated['species'],
            'breed'        => $validated['breed'],
            'service_id'   => $validated['service_id'],
            'scheduled_at' => $validated['scheduled_at'],
            'status'       => 'pending',
            'client_notes' => $validated['client_notes'] ?? null,
        ]);

        return redirect()->route('client.dashboard')
                         ->with('success', 'Appointment booked successfully!');
    }

    public function edit(Appointment $appointment): View
    {
        $services = Service::all();
        return view('appointments.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $request->validate([
            'service_id'   => 'required|integer|exists:services,id',
            'scheduled_at' => 'required|date',
            'status'       => 'required|string|in:pending,in-progress,completed,no-show',
            'notes'        => 'nullable|string|max:1000',
        ]);

        $appointment->update([
            'service_id'   => $request->service_id,
            'scheduled_at' => $request->scheduled_at,
            'status'       => $request->status,
            'notes'        => $request->notes,
        ]);

        return redirect()->route('client.dashboard')
                         ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('client.dashboard')
                         ->with('success', 'Appointment cancelled successfully.');
    }

    public function create(): View
    {
        $services = Service::all();
        $clients  = Client::all();
        $groomers = Groomer::all();

        return view('admin.appointments.create', compact('clients', 'services', 'groomers'));
    }

    // ✅ NEW METHOD: Assign groomer to appointment
    public function assignGroomer(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'groomer_id' => 'required|exists:groomers,id',
        ]);

        $appointment->groomer_id = $validated['groomer_id'];
        $appointment->save();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Groomer assigned successfully.');
    }
}