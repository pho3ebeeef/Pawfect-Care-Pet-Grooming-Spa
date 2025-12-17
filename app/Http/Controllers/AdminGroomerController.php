<?php

namespace App\Http\Controllers;

use App\Models\Groomer;
use Illuminate\Http\Request;

class AdminGroomerController extends Controller
{
    public function index()
    {
        $groomers = Groomer::all();
        return view('admin.groomers.index', compact('groomers'));
    }

    public function create()
    {
        return view('admin.groomers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:groomers,email',
        ]);

        Groomer::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Groomer added successfully.');
    }

    public function show(Groomer $groomer)
    {
        return view('admin.groomers.show', compact('groomer'));
    }

    public function edit(Groomer $groomer)
    {
        return view('admin.groomers.edit', compact('groomer'));
    }

    public function update(Request $request, Groomer $groomer)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:groomers,email,' . $groomer->id,
        ]);

        $groomer->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Groomer updated successfully.');
    }

    public function destroy(Groomer $groomer)
    {
        $groomer->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Groomer deleted successfully.');
    }
}