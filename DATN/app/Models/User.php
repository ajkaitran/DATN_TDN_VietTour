<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'phone',
        'email',
        'username',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function insertDataAdmin($params){
        $params['role'] = 1;
        $res = User::query()->create($params);
        return $res;
    }
    public function insertDataClient($params){
        $params['role'] = 3;
        $params['status'] = 1;
        $res = User::query()->create($params);
        return $res;
    }
    public function loadListAdmin(){
        $query = User::query()
            ->whereIn('role', [0, 1])
            ->orderBy('id')
            ->paginate(5);
        return $query;
    }
    public function loadListUser(){
        $query = User::query()
            ->where('role', 2)
            ->orderBy('id')
            ->paginate(5);
        return $query;
    }
    public function loadListClient(){
        $query = User::query()
            ->where('role', 3)
            ->orderBy('id')
            ->paginate(5);
        return $query;
    }
    public function loadIdUser($id){
        $query = User::query()->find($id);
        return $query;
    }
    public function updateDataUser($params, $id){
        $res = User::query()->find($id)->update($params);
        return $res;
    }

    public function deleteDataUser($id){
        $res = User::query()->find($id)->delete();
        return $res;
    }
}
