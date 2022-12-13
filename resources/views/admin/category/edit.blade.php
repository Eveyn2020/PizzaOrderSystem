@extends('admin.layout.master')

@section('title','Category_Update')

@section('content')
<div class="main-content">
<div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Edit Your Category</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('category#update')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <input type="hidden" name="categoryId" value="{{$category->id}}">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="categoryName" type="text" value="{{old('categoryName',$category->name)}}" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                        </div>
                                        @error('categoryName')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Update</span>
                                                <!-- <span id="payment-button-sending" style="display:none;">Sending…</span> -->
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

@endsection