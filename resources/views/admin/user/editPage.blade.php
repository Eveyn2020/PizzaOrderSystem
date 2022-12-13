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
                                        <h3 class="text-center title-2">{{$user->name}} 's Profile</h3>
                                    </div>
                            
                                    <hr>
                                  
                                    <form action="{{route('user#editUser',$user->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                       <div class="row">
                                           <div class="col-4 offset-1 ">
                                               @if($user->image==null)
                                                   @if($user->gender=='male')
                                                      <img src="{{asset('images/default_user.png')}}" class="img-thumbnai shadow-sm"/>
                                                    @else
                                                       <img src="{{asset('images/female_default.jpg')}}" class="img-thumbnai shadow-sm"/>
                                                     @endif
                                                @else
                                                   <img src="{{asset('storage/'.$user->image)}}" class="img-thumbnail shadow-sm" alt="John Doe" />
                                                @endif

                                                <div class="mt-3">
                                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror " id="">
                                                </div>
                                                @error('image')
                                                   <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <div class="mt-3">
                                                    <button class="btn btn-dark text-white col-12" type="submit"> <i class="fa-solid fa-circle-chevron-right me-2"></i> Update</button>
                                                </div>
                                            </div>

                                        <div class="row col-6">
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{old('name',$user->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Your Name...">
                                        </div>
                                        @error('name')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{old('email',$user->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                        </div>
                                        @error('email')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" value="{{old('phone',$user->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Phone Number..">
                                        </div>
                                        @error('phone')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control  @error('gender') is-invalid @enderror" id="">
                                                <option value="">Choose gender..</option>
                                                <option value="male"  @if($user->gender=='male') selected @endif>male</option>  
                                                <option value="female" @if($user->gender=='female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control  @error('address') is-invalid @enderror" id="" cols="30" rows="5">{{old('address',$user->address)}}</textarea>
                                        </div>
                                        @error('address')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" value="{{old('role',$user->role)}}" class="form-control" placeholder="Enter Role .." disabled>
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