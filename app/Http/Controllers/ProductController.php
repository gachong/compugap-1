<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CsvImport;
use App\Exports\ExportProduct;
use App\Models\ProductMod;





class ProductController extends Controller
{
    

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importView(){
        $products = ProductMod::all();
        $imported = ([
            "file" => "OK"
        ]);
        
      
        return view('importFile')->with('products', $products)->with('imported',$imported);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
 
 
    public function import(Request $request){

        $products = new ProductMod();
        $products->UpdateDB();
        Excel::import(new CsvImport, $request->file('file')->store('files'));
        $imported = ([
            'file'=>'OK'
        ]);
        $products->EliminarCabecera();
        $products = ProductMod::all();
        return view('importFile')->with('products', $products)->with('imported',$imported);
        
    }

    public function exportProducts(Request $request){
        return Excel::download(new ExportProduct, 'users.xlsx');
    }

    /*public function SendApi(){
        try{

            self::CreateJsonProduct();

            return response()->json([
                'code' => 200,
                'data' => null,
                'message' => 'Send Info'
            ]);

        }catch(Exception $e){
            
            return response()->json([
                'code' => 400,
                'data' => $e->getMessage(),
                'message' => 'Conection Fail'
            ]);
        }
        
    }*/

   

    
    
    

   


    

    
}
