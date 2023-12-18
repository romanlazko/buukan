<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {

            $company = $user->company;

            if ($company) {
                return redirect()->route('admin.company.show', $company);
            }

            return redirect()->route('admin.company.create');
        }

        if ($user->employee->company) {
            return redirect()->route('admin.company.employee.schedule.index', [$user->employee->company, $user->employee]);
        }

        return view('admin.dashboard');
    }
}
