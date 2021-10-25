@extends('layouts.admin-master')

@section('content')
@include('layouts.tiny')
    <h1>Edit</h1>

    <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group col-sm-6">
            <label for="category">Category</label>
                <select class="form-control" name="category" id="category">
                   
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
        </div>
        <div class="form-group col-sm-6">
            <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title"aria-describedby="" placeholder="Enter title" value="{{$post->title}}">
                @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
        </div>
        <div class="form-group col-sm-6">
                <div><img height="200px" src="{{asset('images/'.$post->post_image)}}" alt="{{$post->title}}"/></div>
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
                @error('post_image')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
        </div>


        <div class="form-group col-sm-6">
            <textarea name="content" class="form-control" id="tekst" cols="30" rows="10">{{$post->content}}</textarea>
            @error('content')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
        </div>
         <input type="submit" class="btn btn-primary" value="Update Post"/>
    </form>
@endsection