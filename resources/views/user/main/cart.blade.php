@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="orderTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($cartList as $list)
                        <tr>
                            <td><img src="{{asset('storage/'.$list->product_image)}}" class="img-thumbnail" alt="" style="width: 50px;"></td>
                            <td class="align-middle"> {{$list->pizza_name}}</td>
                            <input type="hidden" id="orderId" value="{{$list->id}}">
                            <input type="hidden" id="productId" value="{{$list->product_id}}">
                            <input type="hidden" id="userId" value="{{$list->user_id}}">
                            <td class="align-middle" id="pricePizza">{{$list->pizza_price}} MMK</td>
                            
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn" id="minus">
                                        <button class="btn btn-sm btn-primary btn-minus"  >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                  
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$list->qty}}" id="qty">
                                    <div class="input-group-btn" id="plus">
                                        <button class="btn btn-sm btn-primary btn-plus" >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle col-3" id="total">{{$list->pizza_price*$list->qty}} MMK</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" ><i class="fa fa-times"></i></button></td>
                        </tr>
                        
                            
                        @endforeach
                      
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalprice}} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalprice + 3000}} MMK</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection
    @section('scriptSource')
    <script src="{{asset('js/cart.js')}}"></script>
    <script>
        $('#orderBtn').click(function(){
          
          $orderList=[];
          $random= Math.floor(Math.random() * 1000000001);
          console.log($random);
            $('#orderTable tbody tr').each(function(index,row){
               $orderList.push({
                'user_id' : $(row).find('#userId').val(),
                'product_id' : $(row).find('#productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total' : Number($(row).find('#total').text().replace('MMK','')),
                'order_code' : 'POS'+ $random
               });
            });
          
            $.ajax({
               type : 'get',
               url : 'http://127.0.0.1:8000/user/ajax/order',
               data : Object.assign({},$orderList),
               dataType : 'json',
               success : function(response){
                  
                   window.location = "http://127.0.0.1:8000/user/homePage";
                 }
            })    
        });
           //when clear button click
           $('#clearBtn').click(function(){
           
            $.ajax({
               type : 'get',
               url : 'http://127.0.0.1:8000/user/ajax/clear/cart',
               dataType : 'json'
               
            })   

            $('#orderTable tbody tr').remove();
            $('#subTotalPrice').html('0 MMK');
            $('#finalPrice').html('3000 MMK'); 
        })

          //when click remove button
        $('.btnRemove').click(function(){
        console.log('click cross');
        $parentNode=$(this).parents('tr');
        $orderId=$parentNode.find('#orderId').val();
        $productId=$parentNode.find('#productId').val();
        console.log($orderId,$productId);
        $.ajax({
               type : 'get',
               url : 'http://127.0.0.1:8000/user/ajax/clear/productItem',
               data : {'productId' : $productId,'orderId' : $orderId},
               dataType : 'json'
               
            })   

        $parentNode.remove();
        $totalPrice=0;
        $('#orderTable tbody tr').each(function(index,row){
        $totalPrice+=Number($(row).find('#total').text().replace('MMK',''));
        })
        $('#subTotalPrice').html(`${$totalPrice} MMK`)
        $('#finalPrice').html(`${$totalPrice+3000} MMK`)
   })


  

    </script>


    @endsection
