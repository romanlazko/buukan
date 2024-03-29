<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Casts\Money;

class SubService extends Model
{
    use HasFactory; use HasSlug; use SoftDeletes;

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'price',
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

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'sub_service_employee');
    }

    public function price()
    {
        return $this->price->getAmount()->toInt();
    }

    public function scopeActive($query) 
    {
        return $query->where('active', true);
    }
}
