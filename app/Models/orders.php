<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\products;

class orders extends Model
{    
    use Notifiable;

    protected $table = 'orders';
    
    protected $fillable = [
        'customer_name','customer_phone','unit_price','qty','total_price','address','payment_method',
        'product_id','watershop_id','created_at','updated_at'
    ];

    public function products(){
        return $this->belongsTo(products::class,'product_id','id');
    }


}
