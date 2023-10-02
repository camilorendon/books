<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Illuminate\Support\Str;
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

    protected $append=['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];



    /*
        Accesor (get)
        User::query()-> getFullNameAttribute()->get()
    {
    */
    public function getFullNameAttribute()
    {
        return "{this->name} {this->last_name}"; //camilo rendon
    }


    //mutadores
    //(new User($request->all()))->save(); Así se crearían los registros
    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=bcrypt($value);
    }
    public function setRememberTokenAttribute()
    {
        $this->attributes['remember_token']= Str::random(30);
    }


    public function customer()
    {
        return $this->hasMany(Lend::class, 'customer_id', 'id');
    }

    public function owner()
    {
        return $this->hasMany(Lend::class, 'owner_id', 'id');
    }


}
