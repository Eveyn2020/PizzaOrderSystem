<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct to order page
    public function orderList(){
        $order=Order::select('orders.*','users.name as user_name')
              ->when(request('key'),function($query){
                $query->where('orders.order_code','like','%'. request('key').'%');
                 })
              ->leftJoin('users','users.id','orders.user_id')
              ->orderBy('orders.created_at','desc')
              ->paginate(5);
       
        return view('admin.order.list',compact('order'));
    }

   //admin order status   sort with ajax
   public function changeStatus(Request $request){
    
     $order=Order::select('orders.*','users.name as user_name')
              ->when(request('key'),function($query){
                $query->where('orders.order_code','like','%'. request('key').'%');
                 })
              ->leftJoin('users','users.id','orders.user_id')
               ->orderBy('orders.created_at','desc');
              
    if($request->orderStatus == 'all'){
        $order=$order->paginate(5);
    }else{
        $order=$order->where('orders.status',$request->orderStatus)->paginate(5);
    }
   
    return view('admin.order.list',compact('order'));
     
   }

   //change status 
   public function ajaxChangeStatus(Request $request){
       Order::where('id',$request->orderId)->update([
        'status' => $request->status
       ]);
   }


   //order code list
   public function listInfo($orderCode){
    $order=Order::where('order_code',$orderCode)->first();
    $orderList=OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
               ->leftJoin('users','users.id','order_lists.user_id')
               ->leftJoin('products','products.id','order_lists.product_id')
                ->where('order_code',$orderCode)->get();
    return view('admin.order.productList',compact('orderList','order'));
   }
}
