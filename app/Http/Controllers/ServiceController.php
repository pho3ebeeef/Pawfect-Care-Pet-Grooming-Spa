<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Display all services
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // Show form to create a new service
    public function create()
    {
        return view('services.create');
    }

    // Store new service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        Service::create($validated);
        return redirect()->route('services.index')->with('success', 'Service added!');
    }

    // Show form to edit an existing service
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    // Update existing service
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'Service updated!');
    }

    // Delete a service
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted!');
    }
}