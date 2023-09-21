<?php
namespace App\Http\Helpers;
use Illuminate\Http\Exceptions\HttpResponseException;

class Helper{
    public static function sendError($message, $errors= [], $code = 401)
    {
        $response= ['success'=>false,'message' => $message];

        if(!empty($errors)){
            $response['data'] = $errors;
        }

        throw new HttpResponseException(response()->json($response,$code));
    }

    public static function activeGuard(){

        foreach(array_keys(config('auth.guards')) as $guard){
        
            if(auth()->guard($guard)->check()) return $guard;
        
        }
        return null;
        }
}
