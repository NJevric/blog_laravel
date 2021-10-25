@extends('layouts.admin-master')


@section('content')
@include('layouts.tiny')

<script>
    tinymce.init({
        selector: '#tekst'
    });
</script>
    <h1>Create</h1>
    @if(session('errorMessage'))
        <div class="alert alert-danger">{{session('errorMessage')}}</div>
    @endif
    <div id="summernote">
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
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
                    <input type="text" name="title" class="form-control" id="title"aria-describedby="" placeholder="Enter title">
                    @error('title')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @enderror
            </div>
            <div class="form-group col-sm-6">
                    <label for="file">File</label>
                    <input type="file" name="post_image" class="form-control-file" id="post_image">
                    @error('post_image')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @enderror
            </div>


            <div class="form-group col-sm-6">
                <textarea name="content" class="form-control" id="tekst" cols="30" rows="10"></textarea>
                @error('content')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @enderror
            </div>
            <input type="submit" class="btn btn-primary" value="Create Post"/>
        </form>
    </div>
    
@endsection



    