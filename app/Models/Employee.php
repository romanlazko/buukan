<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasFactory; use SoftDeletes; use HasRoles;

    protected $fillable = [
        'user_id',
        'company_id',
        'description',
        'schedule_model',
        'avatar',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_employee');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->hasMany((new $this->schedule_model)::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function unoccupiedSchedules($date = null)
    {
        return $this->schedule()->unoccupied($date);
    }
}
