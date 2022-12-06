<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\WoocomerCategoriesModel;
use App\Models\WoocomerImagesModel;
use Automattic\WooCommerce\Client;

class WoocomerceModel extends Model
{
    use HasFactory;

     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $table = '';

   protected $fillable = [
        'name',
        'type',
        'regular_price',
        'description',
        'short_description',
        'categories',
        'images'
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
protected $casts = [
    'name' => 'string',
    'type' => 'string',
    'regular_price' => 'string',
    'description' => 'string',
    'short_description' => 'string',
    'categories' => 'array',
    'images' => 'array'
];

function objectToArray(&$object)
{
    return @json_decode(json_encode($object), true);
}

function makeArrayImages($image,$arraImage)
{
    $imageModel = WoocomerImagesModel::create(['src' => $image]);
    $arraImage[] = $imageModel;
    return $arraImage;
}

function makeArrayCategories($categorie,$arraCategories)
{
    $categorieModel = WoocomerCategoriesModel::create(['id' => $categorie]);
    $arraCategories[] = $categorieModel;
    return $arraCategories;
}

public function ConvertObjArray($objProduct){
    $WoocomerArray = [
        'name' => $objProduct->articule,
        'type' => $objProduct->mark,
        'regular_price' => $objProduct->percenttax,
        'description' => $objProduct->articule,
        'short_description' => $objProduct->articule,
        'categories' => self::FoundCategorie($objProduct->category)
    ];
    return $WoocomerArray;
}

public function FoundCategorie($categoriestring){
    $ArrCat = explode(">", $categoriestring);
    $ArrCatFromWoocomerce = self::categoriesfromwoocomerce();
    DD($ArrCatFromWoocomerce);
}

public function categoriesfromwoocomerce(){
    $cltWoocomerce = self::conectWoocomerce();
    $catFromWoocomerce = $cltWoocomerce->get('products/categories');
    DD("qwe");
    DD($catFromWoocomerce);
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




}
