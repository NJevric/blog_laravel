@extends('layouts.admin-master')
@section('content')

  
    <div class="row">
    
        <div class="col-sm-3">
            <h1>Edit</h1>
            <form action="{{route('social.update',$social->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="text" class="form-control" value="{{$social->text}}">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Link</label>
                    <input type="text" id="name" name="href" class="form-control" value="{{$social->href}}">
                    @error('href')
                        {{$message}}
                    @enderror
                </div>
                <input type="submit" id="submit" value="Update Social" class="btn btn-primary mb-4"/>
            </form>
        </div>
        

    </div>
@endsection