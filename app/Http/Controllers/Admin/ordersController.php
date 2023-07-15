<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\deliveryOrders;
use App\Traits\GeneralTrait;

class ordersController extends Controller
{    
    use GeneralTrait;

    // i want to save orders after customer payment 
    // first function to save order for watershop
    //the secound function to view all data on the water shop dashboard
    public function getOrdersForWaterShop(){ //this is for water shop
        $id = \Auth::id();
        $data = orders::where('watershop_id',$id)->with('products')->selection()->get();
        return $this->returnData('200', 'ok', 'orders', $data);
    }

    public function getOrdersForCustomers(){ //this is for customer from his profile
        $id = \Auth::id();
        $data = orders::where('customer_id',$id)->with('products')->selection()->get();
        return $this->returnData('200', 'ok', 'data', $data);
    }

    public function insert(Request $request){ //insert order from customer
            try {
                $customer_id        = \Auth::id();
                $customer_name      = \Auth::name();
                $address            = $request->address;
                $customer_phone     = $request->customer_phone;
                $unit_price         = $request->unit_price;
                $qty                = $request->qty;
                $total_price        = $request->total_price;
                $payment_method     = $request->payment_method;
                $product_id         = $request->product_id;
                $watershop_id       = $request->watershop_id;
        
                $save_orders = orders::create([
                    'customer_id'           => $customer_id,
                    'customer_name'         => $customer_name,
                    'address'               => $address,
                    'customer_phone'        => $customer_phone,
                    'unit_price'            => $unit_price,
                    'qty'                   => $qty,
                    'total_price'           => $total_price,
                    'payment_method'        => $payment_method,
                    'product_id'            => $product_id,
                    'watershop_id'          => $watershop_id,
                ]);   

                return $this->returnSuccess(200,'Insert Successfully');

            } catch (\Exception $ex) {
                return $this->returnError(404,'Please Contact Support !!');
            }
        }
    
        // this function to save order for delivery !
        public function send_orders_to_delivery(Request $request){ 
            //send order from watershop to delivery
            try {
                $save_orders = deliveryOrders::create([
                    'id_order'              => $request->id_order,
                    'id_delivery'           => $request->id_delivery,
                    'delivery_status'       => $request->delivery_status, //deafult 0 -> pending
                    'evidence_photo'        => $request->evidence_photo, //this is a photo -> deafult null
                ]);       
                return $this->returnSuccess(200,'Insert Successfully');
    
            } catch (\Exception $ex) {
                return $this->returnError(404,'Please Contact Support !!');
            }        
        }


}
