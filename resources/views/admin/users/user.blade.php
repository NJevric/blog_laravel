@extends('layouts.admin-master')

@section('content')
    <h1>User {{$user->name}}</h1>
    <div>
    <img class="img-profile mb-4" height="150px" src="{{asset('images/'.$user->user_image)}}" alt="{{$user->name}}">
    </div>
    @if(session('messageUpdate'))
            <div class="alert alert-success">{{session('messageUpdate')}}</div>
        @endif
    <div class="row">
       
        <div class="col-sm-6">
            <form action="{{route('user.profile.update', $user->id)}}" method="post" enctype="multipart/form-data" class="mb-5">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control"/>
                    <div>
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control"/>
                    <div>
                        @error('username')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control"/>
                    <div>
                        @error('email')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="{{$user->email}}" class="form-control"/>
                    <div>
                        @error('password')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="user_image">Profile Picture</label>
                    <input type="file" name="user_image" id="user_image" class="form-control-file"/>
                    <div>
                        @error('image')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Update User" class="btn btn-primary mt-2"/>
            </form>
        </div>
    </div>

    @foreach(auth()->user()->roles as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Authorization')
    <div class="card shadow mb-4 col-sm-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <td>UserHas</td>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Add</th>
                            <th>Remove</th>
                           
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <td>UserHas</td>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Add</th>
                            <th>Remove</th>
                           
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td><input type="checkbox"
                                    @foreach($user->roles as $userRoles)
                                        @if($userRoles->name == $role->name)
                                            checked
                                        @endif
                                    @endforeach
                                ></td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <form action="{{route('user.addRole', $user->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-primary"
                                        @if($user->roles->contains($role))
                                                disabled
                                            @endif
                                            

                                           
                                        >Add</button>
                                    </form>
                               </td>
                                <td>
                                <form action="{{route('user.removeRole', $user->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-danger"
                                        @if(!$user->roles->contains($role))
                                                disabled
                                            @endif
                                        >Remove</button>
                                    </form>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @endforeach
      @endforeach
    
@endsection