@extends('layouts.admin-master')
@section('content')
    <h1>All Posts</h1>

    @if(session('message'))
        <div class="alert alert-danger">{{session('message')}}</div>
        @elseif(session('messageCreated'))
        <div class="alert alert-success">{{session('messageCreated')}}</div>
        @elseif(session('messageUpdate'))
        <div class="alert alert-success">{{session('messageUpdate')}}</div>

    @endif

    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Owner</th>
                      <th>Comments</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Owner</th>
                      <th>Comments</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  
                
                  @foreach(auth()->user()->roles->slice(0,1) as $role)
                    @if($role->name != 'Admin')
                      @foreach($posts as $post)
                      <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category->name}}</td>
                        <td><img height="50px" src="{{asset('images/'. $post->post_image)}}" alt="{{$post->title}}"/></td>
                        <td>{{$post->user->name}}</td>
                        <!-- <td><a href="route('')">View Comments</a></td> -->
                        <td></td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>
                          <form action="{{route('post.edit', $post->id)}}" method="post">
                          @csrf
                          @method('GET')
                          <input type="submit" value="Edit" class="btn btn-success"/>
                          </form>
                        </td>
                        <td>
                          <form action="{{route('post.destroy', $post->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <input type="submit" value="Delete" class="btn btn-danger"/>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    @elseif($role->name == 'Admin')
                      @foreach($postsAllAdmin as $post)
                      <tr>
                          <td>{{$post->id}}</td>
                          <td>{{$post->title}}</td>
                          <td>{{$post->category->name}}</td>
                          <td><img height="50px" src="{{asset('images/'. $post->post_image)}}" alt="{{$post->title}}"/></td>
                          <td>{{$post->user->name}}</td>
                          <td><a href="{{route('comments.filter',$post->id)}}">View Comments</a></td>
                          <td>{{$post->created_at->diffForHumans()}}</td>
                          <td>{{$post->updated_at->diffForHumans()}}</td>
                          <td>
                            <form action="{{route('post.edit', $post->id)}}" method="post">
                            @csrf
                            @method('GET')
                            <input type="submit" value="Edit" class="btn btn-success"/>
                            </form>
                          </td>
                          <td>
                            <form action="{{route('post.destroy', $post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger"/>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                    @endif
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
         
          @foreach(auth()->user()->roles->slice(0,1) as $role)
            @if($role->name == 'Admin')

              {{$postsAllAdmin->links()}} 

            @elseif($role->name!='Admin')

              {{ $posts->links() }}

            @endif
          @endforeach
       
@endsection
@section('tableScripts')
<!-- Page level plugins -->
<script src="{{asset('assets/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <!-- <script src="{{asset('assets/admin/js/demo/datatables-demo.js')}}"></script> -->

@endsection