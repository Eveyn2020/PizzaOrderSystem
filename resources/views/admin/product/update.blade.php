@extends('admin.layout.master')

@section('title','Details Profile')

@section('content')
<div class="main-content">
<div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Update pizza</h3>
                                    </div>
                            
                                    <hr>
                                  
                                    <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                       <div class="row">
                                        <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                           <div class="col-4 offset-1 ">
                                                   <img src="{{asset('storage/'.$pizza->image)}}" alt="John Doe" />
                                                
                                                <div class="mt-3">
                                                    <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror " id="">
                                                </div>
                                                @error('pizzaImage')
                                                   <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <div class="mt-3">
                                                    <button class="btn btn-dark text-white col-12" type="submit"> <i class="fa-solid fa-circle-chevron-right me-2"></i> Update</button>
                                                </div>
                                            </div>

                                        <div class="row col-6">
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName',$pizza->name)}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza Name...">
                                        </div>
                                        @error('pizzaName')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription') is-invalid @enderror" id="" cols="30" rows="7">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                        </div>
                                        @error('pizzaDescription')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control  @error('pizzaCategory') is-invalid @enderror" id="">
                                                <option value="">Choose pizza category..</option>
                                                @foreach($category as $c)
                                                <option value="{{$c->id}}" @if($pizza->category_id==$c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('pizzaCategory')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                       
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice',$pizza->price)}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza Price...">
                                        </div>
                                        @error('pizzaPrice')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                       
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza waithing time...">
                                        </div>
                                        @error('pizzaWaitingTime')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="viewCount" type="number" value="{{old('viewCount',$pizza->view_count)}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="" disabled>
                                        </div>
                                      

                                
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="date" type="text" value="{{old('date',$pizza->created_at->format('j-F-Y'))}}" class="form-control" placeholder="Enter Role .." disabled>
                                        </div>
                                        

                                        </div>
                                        
                                        </div>

                                        
                                    </form>
                                   
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

@endsection