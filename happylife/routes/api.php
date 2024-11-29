<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CostomarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
////////////admin///////
Route::post('register_User',[AdminController::class,'register_User']);
Route::post('login',[AdminController::class,'login']);
Route::post('add_product',[AdminController::class,'add_product']);
Route::post('add_Catagories',[AdminController::class,'add_Catagories']);
Route::get('delete_product/{id}',[AdminController::class,'delete_product']);
Route::get('show_one_products/{id}',[AdminController::class,'show_one_products']);
Route::get('numbers_user',[AdminController::class,'numbers_user']);
Route::post('update_products/{id}',[AdminController::class,'update_products']);
Route::get('numbers_products',[AdminController::class,'numbers_products']);
Route::get('show_products',[AdminController::class,'show_products']);
Route::get('show_one_user/{id}',[AdminController::class,'show_one_user']);
Route::post('update_user/{id}',[AdminController::class,'update_user']);
Route::post('update_wallet/{id}',[AdminController::class,'update_wallet']);
Route::post('delete_wallet/{id}',[AdminController::class,'delete_wallet']);
Route::post('accept_ordar/{id}',[AdminController::class,'accept_ordar']);
Route::post('accept',[AdminController::class,'accept']);
/////////////user////////
Route::get('catagories_Search/{name}',[CostomarController::class,'catagories_Search']);
Route::get('price_Search/{price}',[CostomarController::class,'price_Search']);
Route::post('add_review',[CostomarController::class,'add_review']);
Route::post('add_order',[CostomarController::class,'add_order']);
Route::post('add_order_pro',[CostomarController::class,'add_order_pro']);
