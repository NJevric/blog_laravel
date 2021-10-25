@extends('layouts.admin-master')
@section('content')
   
@if(session('messageCreated'))
        <div class="alert alert-success">
            {{session('messageCreated')}}
        </div>
        @elseif(session('messageDeleted'))
        <div class="alert alert-danger">
            {{session('messageDeleted')}}
        </div>
        @elseif(session('messageUpdated'))
        <div class="alert alert-success">
            {{session('messageUpdated')}}
        </div>
    @endif
    <div class="row">
    
        <div class="col-sm-3">
            <h1>Categories</h1>
            <form action="{{route('category.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
                <input type="submit" id="submit" value="Insert Category" class="btn btn-primary mb-4"/>
            </form>
        </div>
        <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                <form action="{{route('category.edit', $category->id)}}" method="post">
                                        @csrf
                                        @method('GET')
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update"/>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('category.destroy', $category->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <input type="submit" name="submit" class="btn btn-danger" value="Delete"/>
                                    </form>
                                </td>
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