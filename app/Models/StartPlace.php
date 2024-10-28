<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartPlace extends Model
{
    use HasFactory;

    protected $table = 'start_places';

    protected $fillable = [
        'name',
        'sort',
        'active',
        'hot',
        'title',
        'body',
    ];
}
