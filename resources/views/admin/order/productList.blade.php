@extends('admin.layout.master')

@section('title','Order List')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                <div class="ms-5 mt-3" onclick="history.back()">
                                  <i class="fa-solid fa-arrow-left text-dark" ></i> Back
                         </div>
                    <div class="container-fluid">
                        
                        <div class="col-md-12"> 
                            <div class="table-responsive table-responsive-data2">
                               <div class="row col-6">
                                   <div class="card mt-4">
                                      <div class="card-body">
                                          <h3> <i class="fa-solid fa-clipboard me-2"></i> Order Info </h3>
                                          <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i> Include delivery Charges</small>
                                      </div>
                                       <div class="card-body">
                                           <div class="row mb-3">
                                               <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                                             <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                                           </div>
                                           <div class="row mb-3">
                                               <div class="col"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                               <div class="col">{{$orderList[0]->order_code}}</div>
                                           </div>
                                           <div class="row mb-3">
                                               <div class="col"><i class="fa-regular fa-clock me-2"></i>Order Date</div>
                                               <div class="col">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                                           </div>
                                           <div class="row mb-3">
                                               <div class="col"><i class="fa-solid fa-money-bill-1-wave me-2"></i> Total</div>
                                               <div class="col">{{$order->total_price}} MMK</div>
                                           </div>
                                       </div>
                                   </div>

                               </div>
                            
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th></th>
                                           <th>Order Id</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($orderList as $list)
                                            <tr>   
                                                <td></td> 
                                                <td>{{$list->id}}</td>
                                                <td>
                                                <img src="{{asset('storage/'.$list->product_image)}}" class="img-thumbnail" alt="" style="width: 100px;">
                                                </td>
                                                <td>{{$list->product_name}}</td>
                                                <td>{{$list->qty}}</td>
                                                <td >{{$list->total}} MMK</td>
                                        
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                  
                                    </tbody>
                                </table>
                                <div class="">
                               
                                </div>
                            </div>
                         
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>

@endsection
