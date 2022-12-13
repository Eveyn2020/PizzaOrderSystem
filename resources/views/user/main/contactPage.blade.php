@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height:600px;">
        <div class="row px-xl-5">
          @if(session('createSuccess'))
            <div class="col-4 offset-8">
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check"></i> {{session('createSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
            </div>
          @endif
            <div class="col-lg-8 offset-2 bg-light">
                <h3 class="text-center my-5">Contact Us</h3>
                <div class="col-10 offset-1">
                <form action="{{route('contact#contactCreate')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Your Name..." id="">
                            @error('name')
                                 <small class="text-danger">{{$message}}</small>
                              @enderror
                        </div>
                        <div class="col-6">
                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter Your Email..." id="">
                            @error('email')
                                 <small class="text-danger">{{$message}}</small>
                              @enderror
                        </div>
                       <div class="my-4">
                       <textarea name="userMessage" id="" cols="30" rows="10" class="form-control  @error('userMessage') is-invalid @enderror" placeholder="Enter Your Message..."></textarea>
                       @error('userMessage')
                                 <small class="text-danger">{{$message}}</small>
                              @enderror
                    </div>
                       <div class="mb-3">
                       <button class="btn btn-dark text-white col-12" type="submit"> <i class="fa-solid fa-circle-chevron-right me-2"></i> Sent Message</button>
                       </div>
                    </div>
                </form>
                </div>
               
                <div class="my-4">
                 </div>
            </div>
           
            
        </div>
    </div>
    <!-- Cart End -->
    @endsection
    
