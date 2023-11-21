<?php

namespace App\View\Components;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanySidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $company = auth()->user()?->company ?? auth()->user()->employee?->company;

        if ($company) {
            return view('components.company-sidebar', compact([
                'company',
            ]));
        }
        return '';
    }
}
