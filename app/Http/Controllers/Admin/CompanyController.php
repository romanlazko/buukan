<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Services\FileService;

use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') AND !$user->company) {
            return view('admin.company.create');
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request, FileService $fileService)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $fileService->uppload(
                $request->file('logo'), 
                "img/{$request->name}/logo"
            );
        }

        $company = auth()->user()->company()->create([
            ...$data,
            'trial_ends_at' => now()->addDays(31),
        ]);

        $company->createAsStripeCustomer([
            'name' => $company->name,
            'email' => $company->owner->email,
        ]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $clientsCount = $company->clients()->count();

        $appointments = $company->appointments()
            ->where('status', 'done')
            ->where('price', '>', '0')
            ->where('date', '>', now()->subMonth())
            ->get();
            

        $dailySales = $appointments->groupBy(function ($appointment) {
                return $appointment->date->format('d M');
            })
            ->map(function ($dateAppointments, $dateKey) {
                return $dateAppointments->sum('price_amount');
            });
        
        $salesData = [
            'labels' => $dailySales->keys(),
            'values' => $dailySales->values(),
        ];

        $bookingStats = $appointments->groupBy(function ($appointment) {
                return $appointment->service->name;
            })
            ->map(function ($dateAppointments, $dateKey) {
                return $dateAppointments->count();
            });

        return view('admin.company.show', compact(
            'company',
            'clientsCount',
            'salesData',
            'bookingStats'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company, FileService $fileService)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $fileService->uppload(
                $request->file('logo'), 
                "img/{$request->name}/logo"
            );
        }

        $company->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.company.index');
    }
}
