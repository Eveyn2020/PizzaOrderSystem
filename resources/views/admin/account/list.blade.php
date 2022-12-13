@extends('admin.layout.master')

@section('title','Admin_List')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Admin List</h2>
                                    </div>
                                </div>
                                
                            </div>
                            @if(session('createSuccess'))
                            <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{session('createSuccess')}}
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
                            @if(session('updateSuccess'))
                            <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('updateSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                            </div>
                            @endif
                            
                            <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h4>
                            </div>
                            <div class="col-3 offset-6">
                                <form action="{{route('admin#list')}}" method="get">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" value="{{request('key')}}" placeholder="Search...">
                                        <button type="submit" class="btn btn-dark text-white">
                                          <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-1 offset-10 bg-white shadow-sm py-2 px-3  text-center">
                                    <h4><i class="fa-solid fa-database"></i>  {{ $admins-> total()}}   </h4>
                                </div>
                            </div>


                      
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th> Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                      <tr class="tr-shadow">
                                        <input type="hidden" name="" class="userId" value="{{$admin->id}}">
                                            <td class="col-2">
                                                @if($admin->image==null)
                                                  @if($admin->gender=='male')
                                                  <img src="{{asset('images/default_user.png')}}" class="img-thumbnai shadow-sm"/>
                                                  @else
                                                  <img src="{{asset('images/female_default.jpg')}}" class="img-thumbnai shadow-sm"/>
                                                  @endif
                                                @else
                                                <img src="{{asset('storage/'.$admin->image)}}" class="img-thumbnail shadow-sm " alt="">
                                               @endif
                                            </td>
                                            <td class="">
                                                <span>{{$admin->name}}</span>
                                            </td>
                                            <td class="">
                                                <span>{{$admin->email}}</span>
                                            </td>
                                            <td class="">
                                                <span>{{$admin->gender}}</span>
                                            </td>
                                            <td class="">
                                                <span>{{$admin->phone}}</span>
                                            </td>
                                            <td class="">
                                                <span>{{$admin->address}}</span>
                                            </td>
                                            <td class="col-4">
                                                <div class="table-data-feature ">
                                                    @if(Auth::user()->id==$admin->id)

                                                    @else
                                                    <select name="" class="form-control form-control-sm changeStatus me-2" id="">
                                                       <option value="user" @if($admin->role == 'user') selected @endif>User</option>
                                                       <option value="admin" @if($admin->role == 'admin') selected @endif>Admin</option>
                                                    </select>       
                                                    @endif
                                                  
                                                   
                                                   <a href="{{route('admin#delete',$admin->id)}}">
                                                    @if(Auth::user()->id==$admin->id)

                                                    @else
                                                   <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    @endif
                                                   </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>

                                        
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="">
                                
                                 {{$admins->links()}}
                                </div>
                            </div>
                           
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