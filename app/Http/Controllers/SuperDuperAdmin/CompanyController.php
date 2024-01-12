<?php

namespace App\Http\Controllers\SuperDuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(100);

        return view('super-duper-admin.company.index', compact(
            'companies'
        ));
    }
}
