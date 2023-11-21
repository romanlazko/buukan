<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime:H:i'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeUnoccupied($query)
    {
        $query->leftJoin('appointments', function ($join) {
            $join->on('time_based_schedules.employee_id', '=', 'appointments.employee_id')
                ->whereRaw('time_based_schedules.date = appointments.date')
                ->whereRaw('time_based_schedules.term = appointments.term');
        })
        ->where('appointments.status', '!=', 'new')
        ->whereNull('appointments.id')
        ->select('time_based_schedules.*');
    }
}
