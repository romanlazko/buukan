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

        if ($user->hasRole('admin') OR $user->hasRole('administrator')) {

            if ($user->company) {
                return redirect()->route('admin.company.show', $user->company);
            }

            return redirect()->route('admin.company.create');
        }

        if ($user->hasRole('super-duper-admin')) {
            return redirect()->route('super-duper-admin.company.index');
        }

        if ($user->hasRole('administrator')) {
            return redirect()->route('admin.company.appointment.index', $user->employee->company);
        }

        if ($user->hasRole('employee')) {
            return redirect()->route('admin.company.employee.schedule.index', [$user->employee->company, $user->employee]);
        }
    }
}
