<?php


use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//register, login
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

 //dashboard
 Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
 
// Route::group(['middleware'=>'admin_auth'],function(){

// });

Route::middleware(['admin_auth'])->group(function(){
   //admin
   //category
   Route::prefix('category')->group(function(){
       Route::get('list',[CategoryController::class,'list'])->name('category#list');
       Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
       Route::post('create',[CategoryController::class,'create'])->name('category#create');
       Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
       Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#editPage');
       Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });

    Route::prefix('admin')->group(function(){
        //password
        Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

        //account (profile)
        Route::get('admin/details',[AdminController::class,'details'])->name('admin#details');
        Route::get('admin/edit',[AdminController::class,'edit'])->name('admin#edit');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

        //admin List
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
        Route::post('changeRole/{id}',[AdminController::class,'change'])->name('admin#change');

    });

    //product
    Route::prefix('products')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
        route::post('create',[ProductController::class,'create'])->name('product#create');
        route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
        route::post('update/',[ProductController::class,'update'])->name('product#update');
    });

    Route::prefix('orders')->group(function(){
      Route::get('list',[OrderController::class,'orderList'])->name('order#orderList');
      Route::post('change/status',[OrderController::class,'changeStatus'])->name('order#statusChange');
      Route::get('ajax/changeStatus',[OrderController::class,'ajaxChangeStatus'])->name('order#changeStatus');
      Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('order#listInfo');
    
  });

  Route::prefix('user')->group(function(){
    Route::get('list',[UserController::class,'userList'])->name('user#userList');
    Route::get('ajax/userRoleChange',[UserController::class,'changeRole'])->name('user#changeRole');
    Route::get('editPage/{id}',[UserController::class,'editPage'])->name('user#editPage');
    Route::post('editUser/{id}',[UserController::class,'editUser'])->name('user#editUser');
    Route::get('delete/{id}',[UserController::class,'delete'])->name('user#delete');
});
Route::prefix('contact')->group(function(){
  Route::get('list',[ContactController::class,'contactList'])->name('contact#list');
 
 
});

});
   //admin
   //category
Route::group(['prefix'=>'category','middleware'=>'admin_auth'],function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#editPage');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');
});


//user homepage
Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
   Route::get('/homePage',[UserController::class,'home'])->name('user#home');
   Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
   Route::get('/history',[UserController::class,'history'])->name('user#history');
  
   Route::prefix('pizza')->group(function(){
   Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
    
  });

  Route::prefix('cart')->group(function(){
    Route::get('list',[UserController::class,'cartList'])->name('cart#cartList');
    
  });

   Route::prefix('password')->group(function(){
     Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
     Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
   });
   
   Route::prefix('account')->group(function(){
    Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
    Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
    
  });

  Route::prefix('ajax')->group(function(){
    Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
    Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
    Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
    Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
    Route::get('clear/productItem',[AjaxController::class,'clearProduct'])->name('ajax#clearProduct');
    Route::get('viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
  });
  
  
  Route::prefix('contact')->group(function(){
    Route::get('contactPage',[ContactController::class,'contactPage'])->name('contact#contactPage');
    Route::post('contact',[ContactController::class,'contactCrate'])->name('contact#contactCreate');
  });



});

});

