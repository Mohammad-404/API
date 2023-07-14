<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Admin;
// use App\Models\Deliveryorders;
use App\Observers\DeliveryOrdersObserver;

class Delivery extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'delivery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phonenumber','id_workshop','created_at','updated_at'
    ];

    // here is i will make table related
    public function workshop(){
        return $this->belongsTo(Admin::class, 'id_workshop' ,'id');
    }  


    /** Connection Observe With Models */ 
    // protected static function boot(){
    //     parent::boot();
    //     Delivery::observe(DeliveryOrdersObserver::class);
    // }

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
