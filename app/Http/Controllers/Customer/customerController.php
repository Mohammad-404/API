<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
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

    
}
