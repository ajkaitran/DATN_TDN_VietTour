<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StartPlace extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'start_places';

    protected $fillable = [
        'name',
        'active',
        'hot',
        'title',
        'body',
    ];
}
