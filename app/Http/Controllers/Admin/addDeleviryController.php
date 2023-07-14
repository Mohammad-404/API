<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Admin;
use App\Models\deliveryOrders;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;


class addDeleviryController extends Controller
{
    use GeneralTrait;
    
    public function getDelivery(){
        try {
            $id = \Auth::id();
            $data = Admin::where('id',$id)->with('delivery')->selection()->get();

            return $this->returnData('200', 'ok', 'watershop', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }
    
    public function setDelivery(Request $request){
        try {
            $id = \Auth::id();
            Delivery::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'phonenumber'   => $request->phonenumber,
                'id_workshop'   => $id,
            ]);
                        
            return $this->returnSuccess(200,'Registered Successfully');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function deleteDelivery($id){
        try {
            $delivery = Delivery::find($id);
            if (!$delivery) {
                return $this->returnError(404,'Delivery is not found !!');
            }

            // $orders = $delivery->delivery();
            // if (isset($orders) && $orders->count() > 0) {
            //     return $this->returnError(404,'Sorry Cannot Delete Delivery Beacuse Some Relations !!');
            // } 

            $delivery->delete();
            return $this->returnSuccess(200,'Delete Successfully');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function updateDelivery($id,Request $request){
        try {
            $work_shope_id = \Auth::id();
            $delivery = Delivery::find($id);

            if (!$delivery) {
                return $this->returnError(404,'Delivery is not found !!');
            }

            $delivery->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'phonenumber'   => $request->phonenumber,
            ]);


            return $this->returnSuccess(200,'Update Successfully');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function editDelivery($id){
        try {
            $delivery = Delivery::find($id);
            if (!$delivery) {
                return $this->returnError(404,'ID not found !!');
            }
            
            return $this->returnData('200', 'ok', 'delivery', $delivery);

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function view_orders_to_delivery(){ // this function to view all orders including delivery
        try {              
            $id = \Auth::id();
            $data = deliveryOrders::where('id_delivery',$id)->with('orders')->selection()->get();
            return $this->returnData('200', 'ok', 'delivery', $delivery);

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function view_orders_by_id_to_delivery(Request $request,$id){ // this function including delivery
        try {              
            $inside_order = deliveryOrders::with('orders')->find($id);
            //view all data when press on orders also including delivery
            if (!$inside_order) {
                return $this->returnError(404,'ID is not found !!');            
            }
            return $this->returnData('200', 'ok', 'inside_order', $inside_order);

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    
    public function save_status_orders_by_id_to_delivery(Request $request,$id){ // this function including delivery
        try {              
            $save_status_order = deliveryOrders::with('orders')->find($id);
            //to send status
            if (!$save_status_order) {
                return $this->returnError(404,'ID is not found !!');            
            }
            
            $data = deliveryOrders::update([
                'delivery_status'   => $request->delivery_status,
                'evidence_photo'    => $request->evidence_photo,
            ]);

            return $this->returnSuccess(200,'Update Successfully');
            
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

}
