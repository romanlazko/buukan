<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Service;
use App\Models\WebApp;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, WebApp $web_app, Client $client)
    {
        $client = $web_app->company->clients->find($client->id);

        if ($client) {

            $appointments = $client->appointments()->where('status', 'new')->get();

            return view('user.client.appointment.create', compact(
                'web_app',
                'client',
                'appointments'
            ));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, WebApp $web_app, Client $client)
    {
        $service = $web_app->company->services->find($request->service);

        if (!$service) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Service shood be selected" 
            ])->withInput();
        }
        
        $employee = $web_app->company->employees->find($request->employee);

        if (!$employee) {
            return redirect()->back()->with([
                'ok' => false,
                'description' => "Employee shood be selected" 
            ])->withInput();
        }

        $client = $web_app->company->clients->find($client->id);

        if ($client) {
            $client->appointments()->create([
                'employee_id' => $request->employee,
                'service_id' => $request->service,
                'date' => $request->date,
                'term' => $request->term,
                'status' => 'new',
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebApp $web_app, Client $client, Appointment $appointment)
    {
        $client = $web_app->company->clients->find($client->id);

        if ($client) {
            $appointment = $client->appointments->find($appointment);
            if ($appointment) {
                $appointment->update([
                    'status' => 'canceled'
                ]);
            }
        }

        return back();
    }
}
