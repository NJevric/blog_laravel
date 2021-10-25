@extends('layouts.admin-master')
@section('content')
  <h1>Welcome {{auth()->user()->name}}</h1> 

  @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Dashboard')
  <form action="{{route('admin.sort')}}" method="post">

    @csrf
    @method('get')
  <div class="form-group d-flex">
    <select name="ddl" id="ddl" class="form-control col-sm-3">
      <option value="0">Order By Date Desc</option>
      <option value="1">Order By Date Asc</option>
    </select>
    <input type="submit" class="btn btn-primary">
    </div>
  </form>
  <div class="row mt-4 d-flex d-flex">
    <div class="col-sm-5 log mb-5">
      <h2 class="mb-4">User Log</h2>
      @foreach($registersLog as $registerLog)
        <p class="h5">User {{$registerLog->causer_id}} {{$registerLog->description}} User {{$registerLog->subject_id}} with attributes</p>
        <p>{{$registerLog->properties}}</p>
        <p>Date and Time: {{$registerLog->created_at}}</p>
        <hr>
      @endforeach
    </div>
    <div class="col-sm-5 log ml-5">
      <h2 class="mb-4">Posts Log</h2>
      @foreach($postsLog as $postLog)
        <p class="h5">User {{$postLog->causer_id}} {{$postLog->description}} Post {{$postLog->subject_id}} with attributes</p>
        <p>{{$postLog->properties}}</p>
        <p>Date and Time: {{$postLog->created_at}}</p>
        <hr>
      @endforeach
    </div>
    <div class="col-sm-5 log mt-4">
      <h2 class="mb-4">Comments Log</h2>
      @foreach($commentsLog as $commentLog)
      <p class="h5">User {{$commentLog->causer_id}} {{$commentLog->description}} post Comment {{$commentLog->subject_id}} with attributes</p>
        <p>{{$commentLog->properties}}</p>
        <p>Date and Time: {{$commentLog->created_at}}</p>
        <hr>
      @endforeach
    </div>
    <div class="col-sm-5 log mt-4 ml-5">
      <h2 class="mb-4">Permissions Log</h2>
      @foreach($permissionsLog as $permissionLog)
      <p class="h5">User {{$permissionLog->causer_id}} {{$permissionLog->description}} Permission {{$permissionLog->subject_id}} with attributes</p>
        <p>{{$permissionLog->properties}}</p>
        <p>Date and Time: {{$permissionLog->created_at}}</p>
        <hr>
      @endforeach
    </div>
  </div>
  

  @endif
  @endforeach
  @endforeach


  
@endsection