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
        return $this->hasMany(Schedule::class);
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

    public function getFirstNameAttribute()
    {
        return $this->user->first_name;
    }

    public function getLastNameAttribute()
    {
        return $this->user->last_name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getSlugAttribute()
    {
        return $this->user->slug;
    }

    public function getResourceAttribute()
    {
        return collect([
            'employee' => [
                'id' => $this->id,
            ],
        ]);
    }

    public function getAvatarAttribute()
    {
        return $this->attributes['avatar'] ?? 'img/public/preview.jpg';
    }
}
