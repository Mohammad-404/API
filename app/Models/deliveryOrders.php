<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Delivery;
use App\Models\orders;

class deliveryOrders extends Model
{
    use Notifiable;

    protected $table = 'deliveryorders';

    protected $fillable = [
        'id_order','id_delivery','delivery_status','evidence_photo','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('id','id_order','id_delivery','delivery_status',
                                'evidence_photo','created_at','updated_at');
    }

    public function orders(){
        return $this->belongsTo(orders::class,'id_order','id');
    }
    


}
