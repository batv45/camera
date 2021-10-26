<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getCameras',function (){
    $cam = Storage::disk('camera')->directories();
    $camdir = Storage::disk('camera');
    if(!$camdir->has('cameras.json')){
        $camdir->write('cameras.json',Eastwest\Json\Json::encode([]));
    }

    $jss = collect(Eastwest\Json\Json::decode(Storage::disk('camera')->get('cameras.json')));
    return response()->json($jss);
})->name('api.getcameras');
Route::post('setCamName',function (Request $request){
    $request->validate([
        'camid' => 'required|string',
        'camname' => 'required|string'
    ]);
    $jss = collect(Eastwest\Json\Json::decode(Storage::disk('camera')->get('cameras.json')));
    $jss->put($request->input('camid'),$request->input('camname'));
    Storage::disk('camera')
        ->put('cameras.json',\Eastwest\Json\Json::encode($jss));

    return response()->json($jss);
})->name('api.setcamname');

Route::get('/test',function(){
  dd(auth()->guard()->guest() , auth()->guard());
});
