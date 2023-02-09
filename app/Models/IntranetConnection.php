<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntranetConnection extends Model
{
    use HasFactory;

    public static function generateSignature(Array $params)
    {
        $params["api_key"] = env('API_KEY');
        ksort($params);
        $request_params = "";
        foreach ($params as $key => $val){ $request_params = $request_params . $key . $val; }
        $signature = md5($request_params . env('API_SECRET'));

        return $signature;
    }
    public static function fetchDataFromIntranet($location, $data, $params){
        $params_string = "";
        foreach($params as $key => $val) {
            $params_string = $params_string . "" . $key . "=" . $val . "&";
        }
        $url = "http://intranet.cpnv.ch/".$location."/".$data."?".$params_string."api_key=";

        $connection = curl_init();
        curl_setopt_array($connection, [
            CURLOPT_URL => $url . getenv('API_KEY') . "&signature=" . self::generateSignature($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "cache-control: no-cache"
            ],
        ]);
        return json_decode(curl_exec($connection), false);
    }
}
