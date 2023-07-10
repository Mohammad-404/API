<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\deliveryOrders;
use App\Traits\GeneralTrait;

class deliveryOrdersController extends Controller
{
    use GeneralTrait;

    public function update_delivery_order_status($id,Request $request){
        // try {
        //     $status = $request->delivery_status;
        //     $ids = deliveryOrders::find($id);
            
        //     if (!$ids) {
        //         return $this->returnError(404,'ID is not found !!');
        //     }

        //     $ids->update([
        //         'delivery_status'   => $status,
        //         // 'evidence_photo'    => $photo,
        //     ]);
        //     return $this->returnSuccess(200,'Status has been changed success');

        // } catch (\Exception $ex) {
        //     return $this->returnError(404,'Please Contact Support !!');
        // }
    }

}
