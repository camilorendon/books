<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $fillable = [
        'number_id',
        'name',
        'last_name',
        'email',
        'password',
        'status'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];



    public function customer()
    {
        return $this->hasMany(Lend::class, 'customer_id', 'id');
    }

    public function owner()
    {
        return $this->hasMany(Lend::class, 'owner_id', 'id');
    }

}
