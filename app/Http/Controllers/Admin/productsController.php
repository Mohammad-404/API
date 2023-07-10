<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Traits\GeneralTrait;


class productsController extends Controller
{
    use GeneralTrait;
    
    public function get(){
        try {
            $id = \Auth::id();
            $data = products::where('watershop_id',$id)->with('watershope')->selection()->get();
            return $this->returnData('200', 'ok', 'products', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function insert(Request $request){
        try {            
            $id = \Auth::id();
            products::create([
                'watershop_id'                  => $id,
                'product_name'                  => $request->product_name,
                'stock_qty'                     => $request->stock_qty,
                'product_description'           => $request->product_description,
                'price'                         => $request->price,
                'photo'                         => $request->photo,
            ]);
            return $this->returnSuccess(200,'Registered Successfully');
        } catch (\Exception $th) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }
    
    public function update($id){
        try {            
            $water_shop_id = \Auth::id();
            $ids = products::find($id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');            
            }
            $ids->update([
                'watershop_id'                  => $water_shop_id,
                'product_name'                  => $request->product_name,
                'stock_qty'                     => $request->stock_qty,
                'product_description'           => $request->product_description,
                'price'                         => $request->price,
                'photo'                         => $request->photo,
            ]);
            return $this->returnSuccess(200,'Update Successfully');
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function delete($id){
        try {
            $ids = products::find($id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');            
            }
            $ids->delete();
            return $this->returnSuccess(200,'Delete Successfully');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    
    public function edit($id){
        try {
            $products = products::find($id);
            if (!$products) {
                return $this->returnError(404,'ID not found !!');
            }
            
            return $this->returnData('200', 'ok', 'products', $products);

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

}
