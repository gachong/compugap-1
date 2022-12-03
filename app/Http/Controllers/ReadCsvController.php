<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Models\Csvfile;

class ReadCsvController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $cvsfiles = Csvfile::orderBy('id')->paginate(5);
        return view('', compact(''));
    }


    public function storeFile(Request $request){

        $request->validate([
            'file' => 'required'
        ]);
        
       $filename =  time().'.'.$request->csv->getClientOriginalExtension();  
       $detinationpath = storage_path().'/app/files';

        if($request->hasFile('csv')){ 
            $request->csv->move($detinationpath, $filename);
            $fileName = $detinationpath.'/'.$filename;
            Csvfile::create($fileName);
        }

        return redirect()->route('cvs.index')->with('success','Cvs imported successfully.');

    }



}
