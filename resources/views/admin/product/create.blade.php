@extends('admin.layout.master')

@section('title','Create_Pizza')

@section('content')
<div class="main-content">
<div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Create Your Pizza</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#create')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza name...">
                                        </div>
                                        @error('pizzaName')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control" id="">
                                                <option value="">Choose your Category</option>
                                                @foreach($categories as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('pizzaCategory')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="" cols="30" rows="5" class="form-control  @error('pizzaDescription') is-invalid @enderror"  placeholder="Enter Description...">{{old('pizzaDescription')}}</textarea>
                                        </div>
                                        @error('pizzaDescription')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Image</label>
                                            <input type="file" name="pizzaImage" class="form-control  @error('pizzaImage') is-invalid @enderror" id="">
                                        </div>
                                        @error('pizzaImage')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{old('pizzaWaitingTime')}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...">
                                        </div>
                                        @error('pizzaWaitingTime')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice')}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                        </div>
                                        @error('pizzaPrice')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create</span>
                                                <!-- <span id="payment-button-sending" style="display:none;">Sending…</span> -->
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

@endsection