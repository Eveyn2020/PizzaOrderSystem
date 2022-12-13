@extends('admin.layout.master')

@section('title','Details Pizza')

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-4 offset-8 mb-2">
                    @if(session('updateSuccess'))
                            <div class="">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            </div>
                            @endif
        </div>
    </div>
<div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="ms-5 mt-3">
                                  <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                </div>
                                <div class="card-body">
                                    <div class="card-title">
                                        
                                    </div>
                                    
                                    <hr>
                                   <div class="row">
                                    <div class="col-3 offset-1">
                                         <img src="{{asset('storage/'.$pizza->image)}}"  />
                                         
                                    </div>
                                    <div class="col-8 ">
                                        <h3 class="my-3 btn btn-danger d-block w-50 text-center"> {{$pizza->name}}</h3>
                                        <span class="my-3 btn btn-sm btn-dark text-white"><i class="fa-solid fs-5 fa-money-bill-1-wave me-1"></i>{{$pizza->price}} Kyats</span>
                                        <span class="my-3 btn btn-sm btn-dark text-white"><i class="fa-solid fs-5 fa-clock me-1"></i> {{$pizza->waiting_time}} mins</span>
                                        <span class="my-3 btn btn-sm btn-dark text-white"><i class="fa-solid fs-5 fa-eye me-1"></i> {{$pizza->view_count}}</span>
                                        <span class="my-3 btn btn-sm btn-dark text-white"><i class="fa-solid fa-clone me-1"></i> {{$pizza->category_name}}</span>
                                        <span class="my-3 btn btn-sm btn-dark text-white"><i class="fa-solid fs-5 fa-user-clock me-1"></i>  {{$pizza->created_at->format('j-F-Y')}}</span>
                                        <div class="my-3"><i class="fa-solid fs-4 fa-file-lines me-2"></i> Details</div>
                                        <div>{{$pizza->description}}</div>
                                        
                                        
                                    </div>
                                    </div>
                                   </div>

                                   
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

@endsection