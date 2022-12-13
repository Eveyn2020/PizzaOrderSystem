@extends('admin.layout.master')

@section('title','Details Profile')

@section('content')
<div class="main-content">
<div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                            <div class="ms-5 mt-3">
                                  <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                </div>
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Role</h3>
                                    </div>
                            
                                    <hr>
                                  
                                    <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                       <div class="row">
                                           <div class="col-4 offset-1 ">
                                               @if($account->image==null)
                                                   @if($account->gender=='male')
                                                      <img src="{{asset('images/default_user.png')}}" class="img-thumbnai shadow-sm"/>
                                                    @else
                                                       <img src="{{asset('images/female_default.jpg')}}" class="img-thumbnai shadow-sm"/>
                                                     @endif
                                                @else
                                                   <img src="{{asset('storage/'.$account->image)}}" alt="John Doe" />
                                                @endif

                                                <div class="mt-3">
                                                    <button class="btn btn-dark text-white col-12" type="submit"> <i class="fa-solid fa-circle-chevron-right me-2"></i> Change Role</button>
                                                </div>
                                            </div>

                                        <div class="row col-6">
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{old('name',$account->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Your Name..." disabled>
                                        </div>
                                        @error('name')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control  @error('role') is-invalid @enderror" id="">
                                                <option value="">Choose user role..</option>
                                                <option value="admin"  @if($account->role=='admin') selected @endif >Admin</option>  
                                                <option value="user" @if($account->role=='user') selected @endif >User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{old('email',$account->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email..." disabled>
                                        </div>
                                        @error('email')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" value="{{old('phone',$account->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Phone Number.." disabled>
                                        </div>
                                        @error('phone')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control  @error('gender') is-invalid @enderror" id="" disabled>
                                                <option value="">Choose gender..</option>
                                                <option value="male"  @if($account->gender=='male') selected @endif>male</option>  
                                                <option value="female" @if($account->gender=='female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control  @error('address') is-invalid @enderror" id="" cols="30" rows="5"  disabled>{{old('address',$account->address)}}</textarea>
                                        </div>
                                        @error('address')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                       
                                        

                                        </div>
                                        
                                        </div>

                                        
                                    </form>
                                   
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

@endsection