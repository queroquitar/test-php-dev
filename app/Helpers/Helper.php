<?php

namespace App\Helpers;

class Helper{
    // Converte a data do valor real para decimal
    public static function castMoneyRealToDecimal($value){
        if(!empty($value)) {
            return substr_replace(
                filter_var($value,
                    FILTER_SANITIZE_NUMBER_INT),

                '.', -2, -2);
        }

        return null;
    }

    public static function formatFormErrorMsg($messages){
        $msg = '';

        foreach ($messages as $message){
            foreach ($message as $key => $value){
                $msg .= $value . '<br>';
            }
        }

        return $msg;
    }

    public static function castFloatToReal($value){
        if(is_numeric($value) && $value > 0) {
            return number_format($value, 2, ',', '.');
        }

        return null;
    }
}