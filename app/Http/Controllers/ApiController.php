<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Exception;


class ApiController extends Controller
{
    public function TestApi(){

        try{
            $url = 'https://compugap.es/wp-json/wc/v3/orders?consumer_key=ck_f4a40ffdb45d1c198979b486002751cdb1ac784a&consumer_secret=cs_b047bbc440fedf0ec6ab3960540b37713148ff64';
            $response = Http::get($url);
            return response()->json([
                'code' => 200,
                'data' => json_decode($response->body(),true),
                'message' => 'Conection OK'
            ]);

        }catch(Exception $e){

            return response()->json([
                'code' => 400,
                'data' => $e->getMessage(),
                'message' => 'Conection Fail'
            ]);

            
            
        }

    }
}
