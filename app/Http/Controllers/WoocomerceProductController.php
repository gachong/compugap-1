<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use App\Models\ProductMod;
use App\Models\WoocomerceModel;
use Exception;

class WoocomerceProductController extends Controller
{
    
    public function SendApi(){
        $productsDataBase = self::CreatObjProduct();
        self::makeProductodata($productsDataBase);

        
    }

    public function makeProductodata($objProducts){
        $woocomercemodel = new WoocomerceModel();
        foreach( $objProducts as $objproduct){
            $WooProduct = $woocomercemodel->ConvertObjArray($objproduct);  
            dd($WooProduct);  
        }
    }


    
    public function conectWoocomerce(){
        $woocommerce = new Client(
            getenv('WOOCOMERCE_URl'), 
            getenv('WOOCOMERCE_CLIENT_KEY'), // Your consumer key
            getenv('WOOCOMERCE_CLIENT_SECRET_KEY'), // Your consumer secret
            [
                'wp_api' => true, // Enable the WP REST API integration
                'version' => 'wc/v3' // WooCommerce WP REST API version
            ]
        );

        return $woocommerce;
    }

    public function CreatObjProduct(){
        
        $products = ProductMod::all();
        
        return $products;
        
    }

    public function sendProduct($data){

        try{
            $cltWoocomerce = self::conectWoocomerce();
            DD($data);
            $cltWoocomerce->post('products', $data);

        }catch(Exception $e){
            
            return response()->json([
                'code' => 400,
                'data' => null,
                'message' => $e->getMessage()
            ]);
        }
        


    }




}
