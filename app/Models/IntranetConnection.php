<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntranetConnection extends Model
{
    use HasFactory;

    public static function generateSignature($params)
    {
        $queryParams = $params . getenv('API_KEY') . getenv('API_SECRET');
        $signature = md5($queryParams);

        return $signature;
    }
    public static function fetchDataFromIntranet($location, $data, $params){
        $url = "http://intranet.cpnv.ch/".$location."/".$data."?".$params."api_key=";

        $connection = curl_init();
        curl_setopt_array($connection, [
            CURLOPT_URL => $url . getenv('API_KEY') . "&signature=" . self::generateSignature("api_key"),
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
