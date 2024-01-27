<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\CancelAppointmentEvent;
use App\Casts\Money;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'term' => 'datetime:H:i:s',
        'price' => Money::class,
    ];

    public function company()
    {
        return $this->employee->company();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function sub_services()
    {
        return $this->belongsToMany(SubService::class, 'appointment_sub_service');
    }

    public function getResourceAttribute()
    {
        return collect([
            'appointment_id' => $this->id,
            'type' => 'appointment',
            'service' => [
                'id' => $this->service?->id,
                'name' => $this->service?->name,
                
            ],
            'client' => [
                'id' => $this->client?->id,
                'first_name' => $this->client?->first_name,
                'last_name' => $this->client?->last_name,
            ],
        ]);
    }

    public function cancel($price = null, $currency = null)
    {
        $result = $this->update([
            'price'  => $price ?? null,
            'currency' => $currency ?? null,
            'status' => 'canceled',
        ]);

        if ($result) {
            event(new CancelAppointmentEvent($this));
        }
        
        return $result;
    }

    public function getTotalPriceAttribute()
    {
        $prefix = isset($this->service->settings->is_price_from) ? __("from ") : "";

        return $prefix.$this->service->price->plus(
            $this->sub_services->pluck('price')->map(function($price){
                return $price->getAmount()->toInt();
            })->sum()
        );
    }

    public function getTotalPriceAmountAttribute()
    {
        return $this->service->price->plus(
            $this->sub_services->pluck('price')->map(function($price){
                return $price->getAmount()->toInt();
            })->sum()
        )->getAmount()->toInt();
    }

    public function getTotalPriceCurrencyAttribute()
    {
        return $this->service->price->plus(
            $this->sub_services->pluck('price')->map(function($price){
                return $price->getAmount()->toInt();
            })->sum()
        )->getCurrency()->getCurrencyCode();
    }

    public function getPriceAmountAttribute()
    {
        return $this->price?->getAmount()->toInt();
    }

    public function getViaWebappAttribute() :bool
    {
        return $this->via == 'webapp';
    }

    public function getViaTelegramAttribute() :bool
    {
        return $this->via == 'telegram';
    }
}
