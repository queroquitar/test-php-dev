<?php

namespace App\Helpers;

class APIHelper{
    public static function returnSuccess($data){
        $return = [
            'code' => 200,
            'status' => 'success',
            'data' => $data
        ];

        return $return;
    }

    public static function returnNotFound($msg='Record not found'){
        $return = [
            'code' => 404,
            'status' => 'Not Found',
            'message' => $msg
        ];

        return $return;
    }

    public static function returnNotSaved($data){
        $return = [
            'code' => 404,
            'status' => 'Not Registered',
            'message' => $data
        ];

        return $return;
    }

    public static function returnError(){
        $return = [
            'code' => 500,
            'status' => 'Internal Server Error',
            'message' => 'Internal Server Error'
        ];

        return $return;
    }

}