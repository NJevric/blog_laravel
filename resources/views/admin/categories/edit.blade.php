@extends('layouts.admin-master')
@section('content')

    <div class="row">
    
        <div class="col-sm-3">
            <h1>Edit</h1>
            <form action="{{route('category.update',$category->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$category->name}}">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
                <input type="submit" id="submit" value="Update Category" class="btn btn-primary mb-4"/>
            </form>
        </div>
        

    </div>
@endsection