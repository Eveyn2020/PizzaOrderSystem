<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products=Product::get();
        $users=User::get();
        $data=[
            'products' => $products,
            'users' => $users
        ];
        return response()->json($data,200);
    }

    //get all category list
    public function categoryList(){
        $data=Category::get();
        return response()->json($data,200);
    }

     //get all user list
     public function userList(){
        $data=User::get();
        return response()->json($data,200);
    }
      //get all cart list
      public function cartList(){
        $data=Cart::get();
        return response()->json($data,200);
    }
    //get all cart list
    public function orderList(){
        $order=Order::get();
        $orderList=OrderList::get();
        $data=[
            'order'=>$order,
            'orderList' => $orderList
        ];
        return response()->json($data,200);
    }

    //get all contact list
    public function contactList(){
        $data=Contact::get();
        return response()->json($data,200);
    }

    //create category post method
    public function categoryCreate(Request $request){
        $data=[
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response=Category::create($data);
        return response()->json($response,200);
    }

      //create contact post method
      public function contactCreate(Request $request){
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response=Contact::create($data);
        return response()->json($response,200);
    }
   //delete data
    public function deleteCategory(Request $request){
        $data=Category::where('id',$request->id)->first();
        if(isset($data)){
            Category::where('id',$request->id)->delete();
            return response()->json(['status'=>'true','message'=>'Delete Success'],200);
        }
        return response()->json(['status'=>'false','message'=>'Something is wrong'],200);

    }

     //details  category with post method
     public function detailsCategory(Request $request){
        $data=Category::where('id',$request->id)->first();
        if(isset($data)){
         
            return response()->json(['status'=>'true','message'=>$data],200);
        }
        return response()->json(['status'=>'false','message'=>'Something is wrong'],200);

    }

    //details  category with get method
    public function detailsCategoryGetMethod($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
         
            return response()->json(['status'=>'true','message'=>$data],200);
        }
        return response()->json(['status'=>'false','message'=>'Something is wrong'],500);

    }

    //update category
    public function updateCategory(Request $request){
       

        $dbSource=Category::where('id',$request->id)->first();
        if(isset($dbSource)){
            $data=[
                'name' => $request->name,
                'id'=> $request->id,
                'updated_at' => Carbon::now()
            ];
            Category::where('id',$request->id)->update($data);
            return response()->json(['status'=>'true','message'=>'update success'],200);
        }
        return response()->json(['status'=>'false','message'=>'something wrong'],500);
    }
}
