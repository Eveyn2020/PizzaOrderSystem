@extends('admin.layout.master')

@section('title','Users List')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                        @if(session('updateSuccess'))
                            <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            </div>
                            @endif

                            @if(session('deleteSuccess'))
                            <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            </div>
                            @endif
                          <div class="row mt-1">
                                <div class="col-1 offset-10 bg-white shadow-sm py-2 px-3  text-center">
                                    <h4><i class="fa-solid fa-database me-2"></i>{{$users->total()}}</h4>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                           <th> Image</th>
                                           <th> Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <input type="hidden" name="" class="userId" value="{{$user->id}}">
                                       <td class="col-2"> 
                                       @if($user->image==null)
                                            @if($user->gender=='male')
                                                <img src="{{asset('images/default_user.png')}}" class="img-thumbnai shadow-sm"/>
                                            @else
                                                <img src="{{asset('images/female_default.jpg')}}" class="img-thumbnai shadow-sm"/>
                                            @endif
                                        @else
                                            <img src="{{asset('storage/'.$user->image)}}" alt="John Doe" />
                                        @endif
                                       </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->gender}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>
                                        <td class="col-2">
                                            <select name="" class="form-control form-control-sm changeStatus" id="">
                                                <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                                <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                            </select>
                                        </td>
                                        <td class="cpl-1">
                                        <div class="table-data-feature">
                                                   
                                                   <a href="{{route('user#editPage',$user->id)}}" class="pr-2">
                                                   <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                   </a>
                                                   
                                                   <a href="{{route('user#delete',$user->id)}}">
                                                   <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                   </a>
                                                    
                                                </div>
                                        </td>
                                        </tr>
                                        <tr class="spacer"></tr>

                                        @endforeach
                                   
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                {{$users->links()}}
                                </div>
                            </div>
                         
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
       
         //change status
        $('.changeStatus').change(function(){
            $role=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('.userId').val();
            $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/userRoleChange',
                    data : {'role':$role,'userId':$userId},
                    dataType : 'json'
                })  
                location.reload();
                  

        })
  
     });
</script>
@endsection