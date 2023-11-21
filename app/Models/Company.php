<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Romanlazko\Telegram\Models\TelegramBot;
use Spatie\Permission\Models\Role;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Company extends Model
{
    use HasFactory; use HasSlug; use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'ico',
        'dic',
        'address',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'owner_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function sub_services()
    {
        return $this->hasMany(SubService::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function telegram_bots()
    {
        return $this->hasMany(TelegramBot::class, 'owner_id');
    }

    public function web_apps()
    {
        return $this->hasMany(WebApp::class);
    }

    public function getRolesAttribute()
    {
        return Role::whereGuardName('company')->get();
    }
}
