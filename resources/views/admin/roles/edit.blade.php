@extends('layouts.admin-master')
@section('content')

  
    <div class="row">
    
        <div class="col-sm-3">
            <h1>Edit</h1>
            <form action="{{route('roles.update',$role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$role->name}}">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
                <input type="submit" id="submit" value="Update Role" class="btn btn-primary mb-4"/>
            </form>
        </div>
        <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <td>Options</td>
                            <th>Id</th>
                            <th>Name</th>
                            <td>Add</td>
                            <td>Remove</td>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <td>Options</td>
                            <th>Id</th>
                            <th>Name</th>
                            <td>Add</td>
                            <td>Remove</td>
                        </tr>
                        </tfoot>
                        <tbody>

                            @foreach($permissions as $permission)
                                <tr>
                                    <td><input type="checkbox"
                                        @foreach($role->permissions as $rolePermissions)
                                            @if($rolePermissions->name == $permission->name)
                                                checked
                                            @endif
                                        @endforeach
                                    ></td>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td> <form action="{{route('role.addPermission', $role->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="permission" value="{{$permission->id}}">
                                        <button class="btn btn-primary"
                                        @if($role->permissions->contains($permission))
                                                disabled
                                            @endif
                                            

                                           
                                        >Add</button>
                                    </form></td>
                                    <td><form action="{{route('role.removePermission', $role->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="permission" value="{{$permission->id}}">
                                        <button class="btn btn-danger"
                                        @if(!$role->permissions->contains($permission))
                                                disabled
                                            @endif
                                        >Remove</button>
                                    </form></td>
                                </tr>

                            @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

    </div>
@endsection