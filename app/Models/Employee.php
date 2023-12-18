<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasFactory; use SoftDeletes; use HasRoles;

    protected $casts = [
        'settings' => 'object',
    ];

    protected $fillable = [
        'user_id',
        'company_id',
        'description',
        'schedule_model',
        'avatar',
        'settings'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_employee');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
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

    public function telegram_chat()
    {
        return $this->belongsTo(TelegramChat::class);
    }

    public function unoccupiedSchedules($date = null)
    {
        return $this->schedule()->unoccupied($date);
    }

    public function getFirstNameAttribute()
    {
        return $this->admin->first_name;
    }

    public function getLastNameAttribute()
    {
        return $this->admin->last_name;
    }

    public function getEmailAttribute()
    {
        return $this->admin->email;
    }

    public function getSlugAttribute()
    {
        return $this->admin->slug;
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
