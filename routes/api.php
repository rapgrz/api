<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Advertisement;

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

Route::get('advertisements/list', function () {
    return Advertisement::all();
});

Route::get('advertisement/{id}', function ($id) {
    $ad = Advertisement::find($id);

    if(!$ad){
      return response(['error' => 'No advertisement found'], 404);
    }

    $ad->views = $ad->views + 1;
    $ad->save();
    
    return $ad;
});
