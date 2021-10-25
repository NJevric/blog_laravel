@extends('layouts.home-master')

@section('categories')
	@foreach($categories as $category)
	<li>
	<div class="featured-post-slide">

		<div class="post-background" style="background-image:url('images/thumbs/featured/featured-1.jpg');"></div>

		<div class="overlay"></div>			   		

		<div class="post-content">
		<ul class="entry-meta">
			<li>Read posts based on category</li> 	
		</ul>	

		<h1 class="slide-title"><a href="{{route('home.filter',$category->id)}}" title="">{{$category->name}}</a></h1> 
		</div> 				   					  

	</div>
	</li> <!-- /slide -->
	@endforeach

@endsection
@section('content')


@foreach($posts as $post)
<article class="brick entry format-standard animate-this">

	<div class="entry-thumb">
		<a href="{{route('post', $post->id)}}" class="thumb-link">
			<img src="{{asset('images/'.$post->post_image)}}" alt="{{$post->title}}">             
		</a>
	</div>

	<div class="entry-text">
	<div class="entry-header">

		<div class="entry-meta">
			<span class="cat-links">
				<p>{{$post->name}}</p> 
					
			</span>			
		</div>

		<h1 class="entry-title"><a href="{{route('post', $post->id)}}">{{$post->title}}</a></h1>
		
	</div>
			<div class="entry-excerpt">
			{!! Str::limit($post->content, '120', '....') !!}
			</div>
			
		
	</div>

</article> <!-- end article -->

@endforeach


@endsection

@section('pagination')

{{$posts->links()}}



@endsection