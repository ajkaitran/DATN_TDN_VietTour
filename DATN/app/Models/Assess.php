<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assess extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'assess';

    protected $fillable = [
        'order_id',
        'content',
        'star',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
