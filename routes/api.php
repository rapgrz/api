<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Advertisement;
use Illuminate\Support\Facades\Validator;

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

Route::get('advertisement/{id}', function (int $id) {
    // get ad by id
    $ad = Advertisement::find($id);
    // if no ad found return error
    if(!$ad){
      return response(['error' => 'No advertisement found'], 404);
    }
    // increment views by 1 and return ad object
    $ad->views = $ad->views + 1;
    $ad->save();

    return $ad;
});
Route::middleware('apikey')->group(function () {
  Route::post('advertisement/create', function(Request $request){
    // validate provided inputs
    $validator = Validator::make($request->input(), [
      'title' => 'required|string',
      'content' => 'required|string'
    ]);

    if($validator->fails()){
      return response(['error' => $validator->errors()->first()], 400);
    }
    // save object
    $ad = new Advertisement();
    $ad->title = $request['title'];
    $ad->content = $request['content'];
    $ad->save();

    return response(['success' => 'Advertisement created successfully', 'object' => $ad]);
  });

  Route::post('advertisement/{id}/update', function(int $id, Request $request){
    // get ad by id
    $ad = Advertisement::find($id);
    // if no ad found return error
    if(!$ad){
      return response(['error' => 'No advertisement found'], 404);
    }
    // validate provided inputs
    $validator = Validator::make($request->input(), [
      'title' => 'string',
      'content' => 'string'
    ]);

    if($validator->fails()){
      return response(['error' => $validator->errors()->first()], 400);
    }
    // save object
    $ad->title = $request['title'] ?? $ad->title;
    $ad->content = $request['content'] ?? $ad->content;
    $ad->save();

    return response(['success' => 'Advertisement updated successfully']);
  });

  Route::post('advertisement/{id}/delete', function(int $id){
      // get ad by id
      $ad = Advertisement::find($id);
      // if no ad found return error
      if(!$ad){
        return response(['error' => 'No advertisement found'], 404);
      }
      // delete ad
      $ad->delete();

      return response(['success' => 'Advertisement deleted successfully']);
  });
});
