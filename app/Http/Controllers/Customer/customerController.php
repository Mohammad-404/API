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
            
            $filePath = "";
            if($request->has('photo') != ""){
                $filePath = uploadImage('customer' , $request->photo);
            }            
            
            $ids->update([
                'phonenumber'                   => $request->phonenumber,
                'username'                      => $request->username,
                'address'                       => $request->address,
                'email'                         => $request->email,
                'password'                      => $request->password,
                'photo'                         => $filePath,
                'payment'                       => $request->payment,
                'city'                          => $request->city,
                'street'                        => $request->street,
                'bulding_no'                    => $request->bulding_no,
                'apartment_no'                  => $request->apartment_no,
                'nearest_famous_landmark'       => $request->nearest_famous_landmark,
            ]);

            return $this->returnSuccess(404,'Updated Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function updatePaymentCard($id){
        try {
            $ids = customerPayment::find($payment);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');
            }
            
            $ids->update([
                'card_no'           => $request->card_no,
                'card_expire'       => $request->card_expire,
                'code'              => $request->code,
            ]);

            return $this->returnSuccess(404,'Updated Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    
}
