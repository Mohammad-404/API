<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\GeneralTrait;

use Closure;

class CheckAdminToken
{
    use GeneralTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authantication();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('ERROR303','INVALID_TOKEN');
            } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException ){
                return $this->returnError('ERROR303','EXPIRED_TOKEN');
            }else{
                return $this->returnError('ERROR303','TOKEN_NOTFOUND');
            }
        } catch(\Throwable $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('ERROR3001','INVALID_TOKEN');
            } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException ){
                return $this->returnError('ERROR303','EXPIRED_TOKEN');
            }else{
                return $this->returnError('ERROR303','TOKEN_NOTFOUND');
            }
        }

        if (!$user) // if we don't have user
            $this->returnError(trans('Unathanticated'));
            // $this->returnError('ERROR303','Unathanticated');

            return $next($request);
    }
}
