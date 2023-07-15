<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\products;
use App\Models\deliveryOrders;

class orders extends Model
{    
    use Notifiable;

    protected $table = 'orders';
    
    protected $fillable = [
        'customer_id','customer_name','customer_phone','unit_price','qty','total_price','address'
        ,'payment_method','product_id','watershop_id','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select(
            'id','customer_id','customer_name','customer_phone','unit_price','qty',
            'total_price','address','payment_method','product_id',
            'watershop_id','created_at','updated_at'    
        );
    }

    public function products(){
        return $this->belongsTo(products::class,'product_id','id');
    }

    public function deliveryOrders(){
        return $this->belongsTo(deliveryOrders::class,'id_order','id');
    }


}
