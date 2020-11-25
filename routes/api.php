<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
//require __DIR__.'/V1/v1_routes.php';

Route::get('/userr', function (){
    return auth()->user();
})->middleware('auth:sanctum');

Route::get('/check_login', function (){
    return auth()->check();
})->middleware('auth:sanctum');

Route::get('/logout', function (Request $request){
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'خروج با موفقیت انجام شد'], 204);
})->middleware('auth:sanctum');


Route::post('login',[App\Http\Controllers\Api\UserController::class, 'login']);

