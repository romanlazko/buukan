<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'term' => 'datetime:H:i:s'
    ];

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

    public function subServices()
    {
        return $this->belongsToMany(SubService::class, 'appointment_sub_service');
    }

    public function resource()
    {
        return collect([
            'id' => $this->id,
            'type' => 'appointment',
            'date' => $this->date->format('Y-m-d'),
            'term' => $this->term->format('H:i'),
            'price' => $this->price,
            'comment' => $this->comment,
            'status' => $this->status,
            'employee' => [
                'id' => $this->employee->id,
            ],
            'service' => [
                'id' => $this->service->id,
                'name' => $this->service->name,
            ],
            'client' => [
                'id' => $this->client?->id,
                'first_name' => $this->client?->first_name,
                'last_name' => $this->client?->last_name,
            ],
        ]);
    }

    public function cancel()
    {
        return $this->update([
            'status' => 'canceled'
        ]);
    }
}
