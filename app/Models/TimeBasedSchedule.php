<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Interfaces\ScheduleInterface;

class TimeBasedSchedule extends Model implements ScheduleInterface
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'term' => 'datetime:H:i:s'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeUnoccupied($query, $date = null)
    {
        $query->leftJoin('appointments', function ($join) {
            $join->on('time_based_schedules.employee_id', '=', 'appointments.employee_id')
                ->whereIn('appointments.status', ['new', 'done', 'no_done'])
                ->whereRaw('time_based_schedules.date = appointments.date')
                ->whereRaw('time_based_schedules.term = appointments.term');
        })
        ->whereNull('appointments.id')
        ->select('time_based_schedules.*')
        ->when($date, function($query) use ($date){
            $query->where('time_based_schedules.date', $date);
        });
    }

    public function getResourceAttribute()
    {
        return collect([
            'schedule_id' => $this->id,
            'type' => 'schedule',
            'service' => [
                'id' => $this->service?->id,
                'name' => $this->service?->name,
            ],
        ]);
    }
}
