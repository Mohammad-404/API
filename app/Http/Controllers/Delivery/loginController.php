<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Auth;

class loginController extends Controller
{
    use GeneralTrait;

    public function login(Request $request){

        //Validation 
        try {
            $rule = [
                'email'         => 'required',
                'password'      => 'required',
            ];       
            $message = [
                'email.required'      => 'the fields is required',
                'password.required'      => 'the fields is required',
            ];
     
            $validator = Validator::make($request->all(), $rule);
            if($validator->fails()){
                return $this->returnError('3000','UnserName or Password is required fields !!');
            }
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'code' => $ex->getCode(), 'msg' => $ex->getMessage()]);                
        }
        //End Validation

        $credentials = $request->only(['email','password']);
        $token = Auth::guard('delivery-api')->attempt($credentials);

        if (!$token) {
            return $this->returnError('3000','UserName or Password not correct');
        }

        $delivery = Auth::guard('delivery-api')->user(); //return all info delivery
        $delivery->api_token = $token; // add token in the messages

        return $this->returnData('200','Login Success','Success',$delivery);
    }

    public function logout(Request $request){
        try {
                $token = $request->header('auth-token');
                JWTAuth::setToken($token)->invalidate(); //logout
                return $this->returnSuccess('300','Logged out successfully.');
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('ERROR303','INVALID_TOKEN');
            }elseif($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->returnError('ERROR303','EXPIRED_TOKEN');
            }else{
                return $this->returnError('ERROR303','NOTFOUND_TOKEN');
            }
        } catch (\Throwable $th) {
            if ($th instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('ERROR303','INVALID_TOKEN');
            }elseif($th instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->returnError('ERROR303','EXPIRED_TOKEN');
            }else{
                return $this->returnError('ERROR303','NOTFOUND_TOKEN');
            }
        }
    }
}
