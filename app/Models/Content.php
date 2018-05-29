<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Helpers\Helper;

class Content extends Model
{
    protected $table = 'contents';

    protected $dates = [
        'date'
    ];

    protected  $fillable = [
        'name',
        'cost',
        'phone'
    ];

    public function xmlInsert($xml){
        $count = 0;

        for($i=0; $i<=count($xml->id)-1; $i++){
            $content = $this->newInstance();
            $content->cod = (integer)$xml->id[$i];
            $content->name = isset($xml->nome[$i])?(string)$xml->nome[$i]:'';
            $content->date = isset($xml->data[$i])?Carbon::createFromFormat('d/m/Y',$xml->data[$i]):'';
            $content->cost = isset($xml->valor[$i])?Helper::castMoneyRealToDecimal($xml->valor[$i]):'';
            $content->phone = isset($xml->phone[$i])?$xml->phone[$i]:'';
            if($content->save()){
                $count++;
            }
        }

        return $count;
    }
}
