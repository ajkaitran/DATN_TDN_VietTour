<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;

    protected $table = 'schedule_details';
    
    protected $fillable = [
        'order_schedule_id',
        'type',
        'name',
        'gender',
        'birthday',
        'phu_thu',
    ];
}
