<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;

class ordersController extends Controller
{    
    // i want to save orders after customer payment 
    // first function to save order for watershop
    //the secound function to view all data on the water shop dashboard
    public function get(){
        $id = \Auth::id();
        $data = orders::where('watershop_id',$id)->with('products')->selection()->get();
        return $this->returnData('200', 'ok', 'data', $data);
    }

    public function insert(Request $request){
        // $customer_id = \Auth::id();
        // $customer_name = \Auth::id();
        // $address = $request->address;
        // $phone = $request->phone;

        // customer_name
        // customer_phone
        // unit_price
        // qty
        // total_price
        // address
        // payment_method
        // product_id
        // watershop_id

        // $id = \Auth::id();

    }
    

}
