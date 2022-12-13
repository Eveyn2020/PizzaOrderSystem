<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        if($request->status== 'desc'){
            $data=Product::orderBy('created_at','desc')->get();
        }else{
            $data=Product::orderBy('created_at','asc')->get();
        }
        
        return response()->json($data,200);
    }

    //cart
    public function addToCart(Request $request){
       $data=$this->getOrderData($request);
       Cart::create($data);
       $response=[
        'message'=>'Add to cart is complete.',
        'status'=>'success'
       ];
       return response()->json($response,200);
    }

    //order
    public function order(Request $request){
        $total=0;
       foreach($request->all() as $item){
        $data=OrderList::create($item);
        $total+=$data->total;
       }

       logger($data->order_code);
       Cart::where('user_id',Auth::user()->id)->delete();

       Order::create([
        'user_id'=>Auth::user()->id,
        'order_code'=>$data->order_code,
        'total_price'=>$total+3000
       ]);

       $message="order completed.";
       return response()->json($message,200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    //clear product item
    public function clearProduct(Request $request){
       
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->orderId)
        ->delete();
    }
 
    //increase view Count
    public function viewCount(Request $request){
        $product=Product::where('id',$request->productId)->first();
        Product::where('id',$request->productId)->update([
            'view_count' => $product->view_count + 1
        ]);
    }
    

    //change order data to string
    private function getOrderData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

}
