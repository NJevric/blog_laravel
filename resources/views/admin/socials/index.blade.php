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
            <h1>Socials</h1>
            <form action="{{route('socials.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="text" class="form-control">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Link</label>
                    <input type="text" id="name" name="href" class="form-control">
                    @error('href')
                        {{$message}}
                    @enderror
                </div>
                <input type="submit" id="submit" value="Insert Social" class="btn btn-primary mb-4"/>
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
                            <th>Link</th>
                            <th>Name</th>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Link</th>
                            <th>Name</th>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($socials as $social)
                            <tr>
                                <td>{{$social->id}}</td>
                                <td>{{$social->href}}</td>
                                <td>{{$social->text}}</td>
                                <td>
                                <form action="{{route('social.edit', $social->id)}}" method="post">
                                        @csrf
                                        @method('GET')
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update"/>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('social.destroy', $social->id)}}" method="post">
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