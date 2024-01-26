<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Romanlazko\Telegram\Models\TelegramBot;
use Spatie\Permission\Models\Role;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Laravel\Cashier\Billable;
use App\Models\Product;

class Company extends Model
{
    use HasFactory; use HasSlug; use SoftDeletes, Billable;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'ico',
        'dic',
        'address',
        'trial_ends_at',
    ];

    public $casts = [
        'trial_ends_at' => 'datetime'
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
        return $this->belongsTo(Admin::class);
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

    public function appointments()
    {
        return $this->hasManyThrough(Appointment::class, Employee::class);
    }

    public function schedules()
    {
        return $this->hasManyThrough(Schedule::class, Employee::class);
    }

    public function getRolesAttribute()
    {
        return Role::whereGuardName('company')->get();
    }

    public function subscribed(array|null $types = null)
    {
        $products = Product::when($types, function ($query) use ($types) {
            $query->whereIn('type', $types);
        })->pluck('product_id')->toArray();

        foreach ($products as $key => $product) {
            if ($this->subscribedToProduct($product, 'default')) {
                return true;
            }
        }
    }

    public function getActualPlanAttribute()
    {
        return Product::where('product_id', $this->subscription()->items->first()->stripe_product)->first();
    }

    public function getLogoAttribute()
    {
        return $this->attributes['logo'] ?? 'img/public/preview.jpg';
    }
}
