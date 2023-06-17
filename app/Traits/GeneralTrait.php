<?php

namespace App\Traits;

trait GeneralTrait
{
    public function returnError($errNum, $msg){
        return response()->json([
            'Status'        => false,
            'ErrNum'        => $errNum,
            'Msg'           => $msg
        ]);
    }

    public function returnSuccess($errNum, $msg){
        return response()->json([
            'Status'        => true,
            'ErrNum'        => $errNum,
            'Msg'           => $msg,
        ]);
    }

    public function returnData($errNum, $msg, $key, $data){
        return response()->json([
            'Status'        => true,
            'ErrNum'        => $errNum,
            'Msg'           => $msg,
            $key            => $data,
        ]);
    }

}
