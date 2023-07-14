<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Customer;

class customerPayment extends Model
{
    use Notifiable;

    protected $table = 'customerpayment';

    
    protected $fillable = [
        'customer_id','card_no','card_expire','code','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('id','customer_id','card_no','card_expire','code','created_at','updated_at');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id'); 
    }

}
