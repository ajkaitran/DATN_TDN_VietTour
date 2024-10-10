<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartDay extends Model
{
    use HasFactory;

    protected $table = 'start_days';

    protected $fillable = [
        'product_schedule_id',
        'product_id',
        'date',
        'slot',
        'tran_sport',
        'price',
        'price1',
        'price2',
        'price3',
        'price4',
        'price5',
    ];
}
