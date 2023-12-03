<?php
namespace App\Interfaces;

interface ScheduleInterface 
{
    public function employee();
    public function service();
    public function scopeUnoccupied($query, $date = null);
}