<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CsvImport;
use App\Exports\ExportProduct;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importView(){
        $products = Product::all();
        $imported = ([
            "file" => "OK"
        ]);
        
      
        return view('importFile')->with('products', $products)->with('imported',$imported);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
 
 
    public function import(Request $request){

        $products = new Product();
        $products->UpdateDB();
        Excel::import(new CsvImport, $request->file('file')->store('files'));
        $imported = ([
            'file'=>'OK'
        ]);
        $products->EliminarCabecera();
        $products = Product::all();
        return view('importFile')->with('products', $products)->with('imported',$imported);
        
    }

    public function exportProducts(Request $request){
        return Excel::download(new ExportProduct, 'users.xlsx');
    }

    public function SendApi(){
        try{
            $url = getenv('WOOCOMERCE_URl').'/wp-json/wc/v3/data/';
            $client = getenv('WOOCOMERCE_CLIENT_KEY');
            $secret = getenv('WOOCOMERCE_CLIENT_SECRET_KEY');
            $response = Http::withBasicAuth($client, $secret)->get($url);
            return response()->json([
                'code' => 200,
                'data' => $response,
                'message' => 'Send Info'
            ]);

        }catch(Exception $e){
            
            return response()->json([
                'code' => 400,
                'data' => $e->getMessage(),
                'message' => 'Conection Fail'
            ]);
        }
        
    }

    public function TestApi(){

        try{
            $client = getenv('WOOCOMERCE_CLIENT_KEY');
            $secret = getenv('WOOCOMERCE_CLIENT_SECRET_KEY');
            $url = getenv('WOOCOMERCE_URl').'/wp-json/wc/v3/orders?consumer_key='.$client.'&consumer_secret='.$secret;
            $response = Http::withBasicAuth($client, $secret)->get($url);
            return response()->json([
                'code' => 200,
                'data' => $response,
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
