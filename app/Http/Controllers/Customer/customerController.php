<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\customerPayment;
use App\Traits\GeneralTrait;

class customerController extends Controller
{
    use GeneralTrait;


    public function getInfo(){ //this function to get all data when cutomer tried to take order.
        try {
            $customer_id        = \Auth::id();
            $data = Customer::where('id',$customer_id)->selection()->with('customerPayment')->get();
            return $this->returnData('200', 'ok', 'customers_information', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function profile(){
        try {
            $customer_id        = \Auth::id();
            $data = Customer::where('id',$customer_id)->with('customerPayment')->selection()->get();
            return $this->returnData('200', 'ok', 'customers_information', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function updateProfile(){
        try {
            $customer_id        = \Auth::id();
            $ids = Customer::find($customer_id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');
            }
        
        // $filePath = "";
        // if($request -> has('photo')){ //hal find image from request??
        //     $filePath = uploadImage('maincategories' , $request->photo);
        // }

            $ids->update([

            ]);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function updatePaymentCard(){
        // customerPayment
    
    }

    
}
