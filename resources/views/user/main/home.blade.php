
@extends('user.layout.master')

@section('content')


    <!-- Shop Start -->
    <div class="container-fluid ">
        <div class="row px-xl-5 ">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            
                            <label class="mt-2" for="price-all">All Categories</label>
                           <span class="badge border font-weight-normal">{{count($categories)}}</span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between mb-3  py-1">
                           <a href="{{route('user#home')}}">
                           <label class="" for="price-1">All Items</label>
                           </a>
                        </div>
                        
                        @foreach($categories as $category)
                        <div class=" d-flex align-items-center justify-content-between mb-3  pt-1">
                            <!-- <input type="checkbox" class="custom-control-input" id="price-1"> -->
                           <a href="{{route('user#filter',$category->id)}}">
                           <label class="" >{{$category->name}}</label>
                           </a>
                            <!-- <span class="badge border font-weight-normal">150</span> -->
                        </div>
                        @endforeach
                       
                        
                    </form>
                </div>
                <!-- Price End -->
               
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                           
                          <a href="{{route('cart#cartList')}}">
                          <button type="button" class="btn btn-dark position-relative">
                           <i class="fa-solid fa-cart-plus fs-4 text-primary"></i>
                             <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                             {{count($cart)}}
                             
                            </span>
                          </button>
                          </a>

                          <a href="{{route('user#history')}}" >
                          <button type="button" class="btn btn-dark position-relative  text-primary ms-3">
                          <i class="fa-solid fa-clock-rotate-left"></i> History
                             <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                             {{count($history)}}
                             
                            </span>
                          </button>
                          </a>

                            </div>
                            <div class="ml-2">
                                <div class="btn-group ">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                    
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <span class="row" id="myList">
                    @if(count($pizzas)!= 0 )
                    @foreach($pizzas as $pizza)
                       <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4"  id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/'.$pizza->image)}}" alt="" style="height:230px;">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$pizza->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$pizza->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$pizza->price}} kyats</h5>
                                        <!-- <h6 class="text-muted ml-2"><del>25000</del></h6> -->
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                      <p class="text-center bg-dark text-white col-6 offset-3 py-5 fs-1 shadow-sm">There is no pizza. <i class="fa-solid fa-pizza-slice ms-3"></i></p>
                    @endif
                    </span>
                      
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#sortingOption').change(function(){
            $eventOption=$('#sortingOption').val();
            if($eventOption=='asc'){
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/pizzaList',
                    data : {'status' : 'asc'},
                    dataType : 'json',
                    success : function(response){
                         $list=` `;
                         for($i=0;$i<response.length;$i++){
                            $list +=`
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4"  id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="" style="height:250px;">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}} kyats</h5>
                                        <!-- <h6 class="text-muted ml-2"><del>25000</del></h6> -->
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                         }
                         $('#myList').html($list);
                         }
                })
            }else if($eventOption=='desc'){
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/pizzaList',
                    data : {'status' : 'desc'},
                    dataType : 'json',
                    success : function(response){
                        $list=` `;
                         for($i=0;$i<response.length;$i++){
                            $list +=`
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4"  id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="" style="height:250px;">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                        <!-- <h6 class="text-muted ml-2"><del>25000</del></h6> -->
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                         }
                         $('#myList').html($list);
                         }
                })
            }
        })
  
     });
</script>
@endsection