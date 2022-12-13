@extends('admin.layout.master')

@section('title','Change Pasword')

@section('content')
<div class="main-content">
<div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Your Password</h3>
                                    </div>
                             @if(session('changeSucess'))
                            <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{session('changeSucess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            </div>
                            @endif
                            @if(session('notMatch'))
                            <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{session('notMatch')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            </div>
                            @endif
                                    <hr>
                                    <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldPassword" type="password" value="" class="form-control   @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old password...">
                                            @error('oldPassword')
                                               <small class="text-danger">{{$message}}</small>
                                             @enderror

                                        </div>
                                       

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newPassword" type="password" value="" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New password...">
                                        </div>
                                        @error('newPassword')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password" value="" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New password...">
                                        </div>
                                        @error('confirmPassword')
                                          <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount"><i class="fa-solid fa-key me-2"></i> Change Password</span>
                                                <!-- <span id="payment-button-sending" style="display:none;">Sending…</span> -->
                                                
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
</div>
@endsection