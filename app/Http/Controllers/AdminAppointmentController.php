<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client','service'])->get();
        return view('admin.appointments.index', compact('appointments'));
    }
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
    public function create()
    {
        $clients = Client::all();
        $services = Service::all();
        return view('admin.appointments.create', compact('clients','services'));

         return view('admin.appointments.create', [
            'clients' => Client::with('pets')->get(),
            'services' => Service::all(),
            'groomers' => Groomer::all(),
        ]);
    }

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'service_id'   => 'required|exists:services,id',
            'pet_name'     => 'required|string|max:255',
            'breed'        => 'nullable|string|max:255',
            'scheduled_at' => 'required|date',
            'status'       => 'required|in:pending,in-progress,completed,no-show',
        ]);

        Appointment::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $services = Service::all();
        return view('admin.appointments.edit', compact('appointment','clients','services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'service_id'   => 'required|exists:services,id',
            'pet_name'     => 'required|string|max:255',
            'breed'        => 'nullable|string|max:255',
            'scheduled_at' => 'required|date',
            'status'       => 'required|in:pending,in-progress,completed,no-show',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Appointment deleted successfully.');
    }
}   