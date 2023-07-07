<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Admin;
use App\Traits\GeneralTrait;

class addDeleviryController extends Controller
{
    use GeneralTrait;
    
    public function getDelivery(){
        try {
            $id = \Auth::id();
            $data = Admin::where('id',$id)->with('delivery')->selection()->get();
            return $this->returnData('200', 'ok', 'delivery', $data);
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
                'id_workshop'   => $id,
            ]);
            
            return $this->returnSuccess(200,'Registered Successfully');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }
}
