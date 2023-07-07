<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Delivery;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;
    //workshop table
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','pic','address','phonenumber','payment','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select(
            'id','name', 'email', 'password','pic','address','phonenumber','payment','created_at','updated_at'
        );
    }

    public function delivery(){
        return $this->hasMany(Delivery::class, 'id_workshop' ,'id'); 
    }  

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
