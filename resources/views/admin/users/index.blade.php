@extends('layouts.admin-master')

@section('content')
    <h1>Users</h1>

    @if(session('messageDestroy'))
        <div class="alert alert-success">{{session('messageDestroy')}}</div>
    @endif

    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Updated profile date</th>
                            <td>Role</td>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Updated profile date</th>
                            <td>Role</td>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                        </tfoot>
                        <tbody>

                      
                        @foreach($users as $user)

                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                                <img height="50px" src="{{asset('images/'.$user->user_image)}}" alt="{{$user->name}}">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->created_at->diffForhumans()}}</td>
                            <td>{{$user->updated_at->diffForhumans()}}</td>
                            <td>@foreach($user->roles as $role)
                                {{$role->name}}
                            
                            @endforeach</td>
                            <td>
                                <form method="post" action="{{route('user.profile.show', $user->id)}}" method="post">
                                    @csrf
                                    @method('GET')
                                
                                    <input type="submit" value="Edit" class="btn btn-primary"/>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{route('user.destroy', $user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger"/>

                                </form>
                            </td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
      
        {{$users->links()}}
@endsection