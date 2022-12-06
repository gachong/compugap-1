<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductMod extends Model
{
    use HasFactory;

    protected $table = 'products';


    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'codigo',
       'articule',
       'pricewithouttax',
       'percenttax',
       'percentliq',
       'partnumber',
       'stocklocal',
       'mark',
       'categoria_id',
       'category',
       'url_image'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [];

   public function UpdateDB(){

        DB::delete('DELETE FROM products');
   }
   public function EliminarCabecera(){
    DB::delete('DELETE FROM products WHERE codigo like "%digo%"'); 
    //DB::select('ALTER TABLE products AUTO_INCREMENT=1');
   }
}
