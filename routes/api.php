<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('apiTesting',function(){
    $data=[
        'message' => "This is api testing message"
    ];
    return response()->json($data,200);
});

//API link =>  DomainName/api/product/list   (Get)
Route::get('product/list',[RouteController::class,'productList']);

//API link =>  DomainName/api/category/list   (Get)
Route::get('category/list',[RouteController::class,'categoryList']);

//API link =>  DomainName/api/user/list   (Get)
Route::get('user/list',[RouteController::class,'userList']);

//API link =>  DomainName/api/cart/list   (Get)
Route::get('cart/list',[RouteController::class,'cartList']);

//API link =>  DomainName/api/ordrer/list   (Get)
Route::get('order/list',[RouteController::class,'orderList']);

//API link =>  DomainName/api/contact/list   (Get)
Route::get('contact/list',[RouteController::class,'contactList']);

//API link =>  DomainName/api/category/list   (post)
Route::post('category/create',[RouteController::class,'categoryCreate']);

//API link =>  DomainName/api/contact/create   (post)
Route::post('contact/create',[RouteController::class,'contactCreate']);

//API link =>  DomainName/api/category/delete/4   (get)   4 is id number
// Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']);

//API link =>  DomainName/api/category/delete   (post)
Route::post('category/delete',[RouteController::class,'deleteCategory']);

//API link =>  DomainName/api/category/details   (post)
Route::post('category/details',[RouteController::class,'detailsCategory']);

//API link =>  DomainName/api/category/details   (get)
Route::get('category/details/{id}',[RouteController::class,'detailsCategoryGetMethod']);


//API link =>  DomainName/api/category/update   (post)
Route::post('category/update',[RouteController::class,'updateCategory']);

