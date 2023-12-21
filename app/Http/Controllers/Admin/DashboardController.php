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

            if ($user->company) {
                return redirect()->route('admin.company.show', $user->company);
            }

            return redirect()->route('admin.company.create');
        }

        if ($user->employee->hasRole('administrator', 'company')) {
            return redirect()->route('admin.company.appointment.index', $user->employee->company);
        }

        if ($user->employee->hasRole('employee', 'company')) {
            return redirect()->route('admin.company.employee.schedule.index', [$user->employee->company, $user->employee]);
        }
    }
}
