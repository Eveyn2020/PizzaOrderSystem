@extends('admin.layout.master')

@section('title','Category_List')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Contact List</h2>
    
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row mt-1">
                                <div class="col-1 offset-10 bg-white shadow-sm py-2 px-3  text-center">
                                    <h4><i class="fa-solid fa-database"></i> {{$data->total()}}</h4>
                                </div>
                            </div>


                 
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($data as $d)
                                        <tr class="tr-shadow">
                                            <td class="col-2">{{$d->name}}</td>
                                            <td class="col-4">{{$d->email}}</td>
                                            <td class="col-6">{{$d->message}}</td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                     @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                {{$data->links()}}
                                </div>
                            </div>
                           
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>

@endsection