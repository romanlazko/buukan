<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Casts\Money;

class Service extends Model
{
    use HasFactory; use HasSlug; use SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'price',
        'img',
        'color',
        'currency',
        'settings',
        'active'
    ];

    protected $casts = [
        'price' => Money::class,
        'settings' => 'object',
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

    public function sub_services()
    {
        return $this->hasMany(SubService::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'service_employee');
    }

    public function price()
    {
        return $this->price->getAmount()->toInt();
    }

    public function scopeActive($query) 
    {
        return $query->where('active', true);
    }

    // public function getPriceAttribute()
    // {
    //     return $this->attributes['price']->getAmount()->toInt();
    // }
}
