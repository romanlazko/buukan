<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekdayBasedSchedule extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'weekday',
        'start_time',
        'end_time'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
