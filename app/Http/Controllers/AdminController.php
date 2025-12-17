<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Groomer;
use App\Models\Service;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Quick stats
        $clientCount   = Client::count();
        $groomerCount  = Groomer::count();
        $serviceCount  = Service::count();
        $upcomingCount = Appointment::where('scheduled_at', '>=', now())->count();

        // Data for tables
        $clients      = Client::all();
        $groomers     = Groomer::all();
        $services     = Service::all();
        $appointments = Appointment::with(['pet','client','service','groomer'])
                                   ->latest()
                                   ->get();

        return view('admin.dashboard', compact(
            'clientCount',
            'groomerCount',
            'serviceCount',
            'upcomingCount',
            'clients',
            'groomers',
            'services',
            'appointments'
        ));
    }
}