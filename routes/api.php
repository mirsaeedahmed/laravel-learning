<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


//TODO request and resource to be implemented.
Route::post('user/register', [UserController::class, 'store']);

//TODO request and resource to be implemented.
Route::get('user/all', [UserController::class, 'index']);

//Route::post('advertiser/create-ad', 'AdController@index')->middleware('checkRole:Advertiser');
//Route::get('advertiser/create-ad', function (Request $request) {
//    return "Create Ad Route";
//})->middleware(["checkRole:user","checkRole:author"]);;
