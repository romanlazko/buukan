<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Romanlazko\Telegram\Models\TelegramChat;
use Romanlazko\Telegram\Models\TelegramBot;

class Employee extends Model
{
    use HasFactory; use SoftDeletes;

    protected $casts = [
        'settings' => 'object',
    ];

    protected $fillable = [
        'user_id',
        'company_id',
        'description',
        'schedule_model',
        'avatar',
        'settings',
        'telegram_chat_id'
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

    public function scopeRole($query, $role)
    {
        return $query->whereHas('admin', function($query) use($role){
            return $query->whereHas('roles', function($query) use($role){
                return $query->where('name', $role);
            });
        });
    }

    public function hasRole($role)
    {
        return $this->admin->hasRole($role);
    }

    public function telegram_bot()
    {
        return $this->telegram_chat->bot();
    }
}
