<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SubService;
use Illuminate\Http\Request;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;

class SubServiceController extends Controller
{

    public function index(Request $request, Company $company)
    {
        $sub_services = $company->sub_services()
            ->when($request->has('search'), function($query) use($request) {
                return $query->where('sub_services.name', 'like', "%{$request->search}%")
                    ->orWhere('sub_services.description', 'like', "%{$request->search}%");
            })
            ->get();

        return view('admin.company.sub_service.index', compact(
            'sub_services',
            'company'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('admin.company.sub_service.create', compact(
            'company'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request, Company $company)
    {
        $company->sub_services()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'color' => $request->color,
            'currency' => 'CZK',
            'settings'  => $request->settings,
        ]);
        
        return redirect()->route('admin.company.sub_service.index', compact([
            'company'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, SubService $sub_service)
    {
        $sub_service = $company->sub_services()->find($sub_service->id);

        if (!$sub_service) {
            return redirect()->route('admin.company.sub_service.index', $company)->with([
                'ok' => false,
                'description' => 'Sub service not found'
            ]);
        }

        return view('admin.company.sub_service.edit', compact(
            'company',
            'sub_service'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Company $company, SubService $sub_service)
    {
        $sub_service = $company->sub_services()->find($sub_service->id);

        if (!$sub_service) {
            return redirect()->route('admin.company.sub_service.index', $company)->with([
                'ok' => false,
                'description' => 'Sub service not found'
            ]);
        }

        $sub_service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'color' => $request->color,
            'currency' => 'CZK',
            'settings'  => $request->settings,
        ]);

        return redirect()->route('admin.company.sub_service.index', $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, SubService $sub_service)
    {
        $sub_service = $company->sub_services()->find($sub_service->id);

        if (!$sub_service) {
            return redirect()->route('admin.company.sub_service.index', $company)->with([
                'ok' => false,
                'description' => 'Sub service not found'
            ]);
        }

        $sub_service->delete();

        return redirect()->route('admin.company.sub_service.index', compact([
            'company'
        ]));
    }
}
