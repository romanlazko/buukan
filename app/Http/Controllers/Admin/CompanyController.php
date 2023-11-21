<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $photo = $request->file('logo');

            // Генерация уникального имени файла
            $fileName = uniqid('logo_') . '.' . $photo->getClientOriginalExtension();

            // Сохранение файла по указанному пути

            $directory = "public/img/{$request->name}/logo";
        
            // Создание соответствующих подпапок, если они не существуют
            Storage::makeDirectory($directory);

            // Сохранение файла по указанному пути
            $path = $photo->storeAs($directory, $fileName);

            // Путь к сохраненному файлу
            $logoPath = Storage::url($path);

            $data['logo'] = $logoPath;
        }

        auth()->user()->company()->create($data);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('admin.company.show', compact('company'));
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
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $photo = $request->file('logo');

            // Генерация уникального имени файла
            $fileName = uniqid('logo_') . '.' . $photo->getClientOriginalExtension();

            // Сохранение файла по указанному пути

            $directory = "public/img/{$company->slug}/logo";
        
            // Создание соответствующих подпапок, если они не существуют
            Storage::makeDirectory($directory);

            // Сохранение файла по указанному пути
            $path = $photo->storeAs($directory, $fileName);

            // Путь к сохраненному файлу
            $logoPath = Storage::url($path);

            $data['logo'] = $logoPath;
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
