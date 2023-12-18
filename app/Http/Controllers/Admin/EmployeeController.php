<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Services\FileService;
use App\Http\Services\UserService;
use App\Models\Company;
use App\Models\Employee;
use App\Models\ScheduleType;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company)
    {
        $employees = $company->employees()
            ->when($request->has('search'), function($query) use($request) {
                return $query->where(function ($query) use ($request){
                    $query->whereHas('user', function ($query) use ($request) {
                        $query->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($request->search) . '%'])
                            ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($request->search) . '%'])
                            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($request->search) . '%']);
                    });
                });
            })
            ->get();

        return view('admin.company.employee.index', compact(
            'employees',
            'company'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('admin.company.employee.create', compact(
            'company',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request, Company $company, UserService $userService, FileService $fileService)
    {
        $user = Admin::whereEmail($request->email)->first();

        if ($user) {
            if (!$user->hasRole('admin')) {
                return back()->with([
                    'ok' => false,
                    'description' => "User already exists"
                ]);
            }
        }

        if (!$user) {
            $user = Admin::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make('12345678'),
            ]);
        }

        if ($request->hasFile('avatar')) {
            $filePath = $fileService->uppload(
                $request->file('avatar'), 
                "img/{$company->slug}/employees"
            );
        }

        $employee = $user->employee()->create([
            'company_id' => $company->id,
            'description' => $request->description,
            'avatar' => $filePath ?? null,
            'settings' => $request->settings,
        ])->assignRole($request->roles);

        $employee->services()->sync($request->services);

        return redirect()->route('admin.company.employee.index', compact([
            'company'
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Employee $employee)
    {
        return view('admin.company.employee.show', compact([
            'company',
            'employee'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, Employee $employee)
    {
        return view('admin.company.employee.edit', compact([
            'company',
            'employee'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, Employee $employee, FileService $fileService)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'description' => ['required'],
        ]);

        $employee = $company->employees->find($employee->id);

        if (!$employee) {
            return redirect()->route('admin.company.employee.index', compact([
                'company'
            ])); 
        }

        if ($employee->user) {
            $user = $employee->admin->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
        }

        $employee->update([
            'company_id' => $company->id,
            'description' => $request->description,
            'settings' => $request->settings,
        ]);

        if ($request->hasFile('avatar')) {
            $filePath = $fileService->uppload(
                $request->file('avatar'), 
                "img/{$company->slug}/employees"
            );
            $employee->update([
                'avatar' => $filePath
            ]);
        }

        $employee->roles()->sync($request->roles);

        $employee->services()->sync($request->services);

        return redirect()->route('admin.company.employee.show', compact([
            'company',
            'employee'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.company.employee.index', compact([
            'company'
        ]));
    }
}
