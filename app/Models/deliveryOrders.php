<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Delivery;

class deliveryOrders extends Model
{
    use Notifiable;

    protected $table = 'deliveryorders';

    protected $fillable = [
        'customer_name','customer_number','customer_address','price','payment_method','id_order','id_delivery'
        ,'created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('id','customer_name','customer_number','customer_address',
        'price','payment_method','id_order','id_delivery','created_at','updated_at');
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class, 'id_delivery','id');
    }


}
