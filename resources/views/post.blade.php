@extends('layouts.post-master')

@section('content')

<div class="content-media">
    <div class="post-thumb">
        <img src="{{asset('images/'.$post->post_image)}}" alt="{{$post->title}}"> 
    </div>  
</div>

<div class="primary-content">

    <h1 class="page-title">{{$post->title}}</h1>	

    <ul class="entry-meta">
        <li class="date">{{$post->created_at->diffForHumans()}}</li>						
        <li class="cat">{{$post->category->name}}</li>				
    </ul>						

    <p>{!! $post->content !!}</p>
    <div class="author-profile">
        <img src="{{asset('images/'.$post->user->user_image)}}" alt="{{$post->user->name}}">

        <div class="about">
            <h4>Author : <a href="#">{{$post->user->name}} ({{$post->user->username}})</a> </h4>
            <a href="mailto:{{$post->user->email}}">Contact creator : {{$post->user->email}}</a>

       
        </div>
		  		
</div> <!-- end entry-primary -->	

@endsection

@section('comments')

    @foreach($comments as $comment)
    <li class="depth-1">


        <div class="comment-content">

            <div class="comment-info">
            <cite>{{$comment->commentUsername}}</cite>

            <div class="comment-meta">
                <time class="comment-time" datetime="2014-07-12T23:05">{{$comment->created_at}}</time>
            </div>
            </div>

            <div class="comment-text">
            <p>{{$comment->commentText}}</p>
            
            </div>

        </div>

    </li>
    @endforeach

@endsection

