<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin;
use App\Models\orders;

class products extends Model
{
    use Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'watershop_id','product_name','stock_qty','product_description','price','photo','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('id','watershop_id','product_name','stock_qty','product_description','price','photo',
                                'created_at','updated_at');
    }

    public function watershope(){
        return $this->belongsTo(Admin::class, 'watershop_id' ,'id'); 
    }

    public function orders(){
        return $this->hasMany(orders::class,'product_id','id');
    }
}
