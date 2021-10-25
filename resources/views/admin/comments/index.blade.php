@extends('layouts.admin-master')

@section('content')
    <h1>Comments</h1>

    @if(session('messageDeleted'))
        <div class="alert alert-danger">
            {{session('messageDeleted')}}
        </div>
    @endif

    <div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>

                            <td>User Username</td>
                            <td>Post Id</td>

                            <td>Is Active</td>
                            <td>Comment Text</td>
                            <td>Unapprove</td>
                            <td>Approve</td>
                            <td>Delete</td>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>

                            <td>User Username</td>
                            <td>Post Id</td>
                           
                            <td>Is Active</td>
                            <td>Comment Text</td>
                            <td>Unapprove</td>
                            <td>Approve</td>
                            <td>Delete</td>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->author}}</td>
                                <td>{{$comment->commentUsername}}</td>
                                <td>{{$comment->post_id}}</td>
                                <td>{{$comment->is_active}}</td>
                                <td>{{$comment->commentText}}</td>
                                <td>
                                    <form action="{{route('comments.update',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Unapprove">
                                      
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('comments.update',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('put')
                                        <input type="hidden" name="is_active" value="1">
                                       
                                        <input type="submit" name="submit" class="btn btn-primary" value="Approve">
                                  
                                    </form>
                                </td>
                                <td> <form action="{{route('comments.destroy',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                      
                                  
                                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
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