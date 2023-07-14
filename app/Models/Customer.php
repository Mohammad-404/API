<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\customerPayment;

class Customer extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phonenumber','username','address','email','password','photo',
        'payment','city','street','bulding_no','apartment_no','nearest_famous_landmark','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select(
            'id','phonenumber','username','address','email','password','photo',
            'payment','city','street','bulding_no','apartment_no',
            'nearest_famous_landmark','created_at','updated_at'
        );
    }

    public function customerPayment(){
        return $this->hasMany(customerPayment::class,'customer_id','id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
