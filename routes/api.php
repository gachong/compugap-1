<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::group(['middleware' => ['auth']], function () {
    Route::resource('services', 'Api\ServiceController')
        ->only(['index', 'store', 'show', 'edit', 'update','destroy']);
});
*/

Route::get('/testapi',[ApiController::class,'TestApi'])->name('test-api');
