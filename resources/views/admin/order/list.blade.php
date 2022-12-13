@extends('admin.layout.master')

@section('title','Order List')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h4>
                            </div>
                            <div class="col-4 offset-5">
                                <form action="{{route('order#orderList')}}" method="get">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" value="{{request('key')}}" placeholder="Search by order code...">
                                        <button type="submit" class="btn btn-dark text-white">
                                          <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-1 offset-10 bg-white shadow-sm py-2 px-3  text-center">
                                    <h4><i class="fa-solid fa-database"></i> {{$order->total()}}</h4>
                                </div>
                            </div>

                            <form action="{{route('order#statusChange')}}" method="Post">
                            <div class="d-flex mb-3">
                              @csrf 
                                <select name="orderStatus" id="orderStatus" class="form-control col-2 me-2 ">
                                    <option value="all">All Status</option>
                                    <option  value="0" @if(request('orderStatus')==0) selected @endif>Pending</option>
                                    <option  value="1" @if(request('orderStatus')==1) selected @endif>Accept</option>
                                    <option  value="2" @if(request('orderStatus')==2) selected @endif>Reject</option>
                                </select>    
                                <button type="submit" class="btn btn-sm btn-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i></button>
                             </div>
                            
                            </form>
                       
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                           <th>User Id</th>
                                            <th>User Name</th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="myList">
                                   @foreach($order as $o)
                                   <tr class="tr-shadow">
                                    <input type="hidden" class="orderId" value="{{$o->id}}">
                                        <td>{{$o->user_id}}</td>
                                        <td>{{$o->user_name}}</td>
                                        <td>{{$o->created_at->format('F-j-Y')}}</td>
                                        <td >
                                            <a href="{{route('order#listInfo',$o->order_code)}}">{{$o->order_code}}</a>
                                        </td>
                                        <td class="amount">{{$o->total_price}} MMK</td>
                                        <td>
                                            <select name="status" id="" class="form-control changeStatus">
                                                <option @if($o->status == 0) selected @endif value="0">Pending</option>
                                                <option @if($o->status == 1) selected @endif value="1">Accept</option>
                                                <option @if($o->status == 2) selected @endif value="2">Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                   @endforeach
                                    </tbody>
                                </table>
                                <div class="">
                                 {{$order->links()}}
                                </div>
                            </div>
                         
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        console.log('Hello Jquery');
        $('#orderStatus').change(function(){
            $status=$('#orderStatus').val();
             console.log( $status);
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/orders/ajax/status',
                    data : {'status':$status},
                    dataType : 'json',
                    success : function(response){
                        
                        $list=` `;
                         for($i=0;$i<response.length;$i++){

                             //for order date  and date format 
                            $months=['January','February','March','April','May','June','July','August','September','October','November','December'];
                            $dbDate=new Date(response[$i].created_at);
                            $finalDate=$months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();
                           
                            if(response[$i].status == 0){
                                $statusMessage=`
                                <select name="status" id="" class="form-control changeStatus">
                                                <option value="0" selected>Pending</option>
                                                <option value="1">Accept</option>
                                                <option value="2">Reject</option>
                                            </select>
                                `;

                            }else if(response[$i].status == 1){
                                $statusMessage=`
                                <select name="status" id="" class="form-control changeStatus">
                                                <option value="0">Pending</option>
                                                <option value="1" selected>Accept</option>
                                                <option value="2">Reject</option>
                                            </select>
                                `;

                            }else if(response[$i].status == 2){
                                $statusMessage=`
                                <select name="status" id="" class="form-control changeStatus">
                                                <option value="0">Pending</option>
                                                <option value="1">Accept</option>
                                                <option value="2" selected>Reject</option>
                                            </select>
                                `;

                            }

                            $list +=`
                            <tr class="tr-shadow">
                               <input type="hidden" class="orderId" value="${response[$i].id}">
                               <td>${response[$i].user_id}</td>
                               <td>${response[$i].user_name}</td>
                               <td>${$finalDate}</td>
                               <td>${response[$i].order_code}</td>
                               <td>${response[$i].total_price} MMK</td>
                               <td>${$statusMessage}</td>
                            </tr>
                                    <tr class="spacer"></tr>
                            `;
                         }
                         $('#myList').html($list);
                         
                         }
                })
           
          
           
        })

         //change status
        $('.changeStatus').change(function(){
            $status=$(this).val();
            $parentNode=$(this).parents('tr');
            $orderId=$parentNode.find('.orderId').val();

            $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/orders/ajax/changeStatus',
                    data : {'status':$status,'orderId':$orderId},
                    dataType : 'json',
                    success : function(response){
                      
                    }
                })         

        })
  
     });
</script>
@endsection