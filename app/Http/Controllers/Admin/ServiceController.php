<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Services\FileService;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function __construct(private FileService $fileService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company)
    {
        $services = $company->services()
            ->when($request->has('search'), function($query) use($request) {
                return $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            })
            ->get();

        return view('admin.company.service.index', compact(
            'services',
            'company'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('admin.company.service.create', compact(
            'company',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request, Company $company)
    {
        $service = $company->services()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'color' => $request->color,
            'currency' => 'CZK',
        ]);

        return redirect()->route('admin.company.service.index', $company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, Service $service)
    {
        $service = $company->services()->find($service->id);

        if (!$service) {
            return redirect()->route('admin.company.service.index', $company)->with([
                'ok' => false,
                'description' => 'Service not found'
            ]);
        }

        return view('admin.company.service.edit', compact(
            'company',
            'service'
        ));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Company $company, Service $service)
    {
        $service = $company->services()->find($service->id);

        if (!$service) {
            return redirect()->route('admin.company.service.index', $company)->with([
                'ok' => false,
                'description' => 'Service not found'
            ]);
        }

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'color' => $request->color
        ]);

        $service->employees()->sync($request->employees);

        return redirect()->route('admin.company.service.index', $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Service $service)
    {
        $service = $company->services()->find($service->id);

        if (!$service) {
            return redirect()->route('admin.company.service.index', $company)->with([
                'ok' => false,
                'description' => 'Service not found'
            ]);
        }

        $service->employee()->schedules->where($service->id)->get()->each(function ($schedule) {
            $schedule->delete();
        });

        $service->delete();

        return redirect()->route('admin.company.service.index', compact([
            'company'
        ]));
    }
}
