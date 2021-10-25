<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

  @include('fixed.global.head')

</head>

<body id="top">

	<!-- header 
   ================================================== -->
   <header class="short-header">   

   	<div class="gradient-block"></div>

   @include('fixed.global.nav')	
   	
   </header> <!-- end header -->


   <!-- masonry
   ================================================== -->
   <section id="content-wrap" class="blog-single">
   	<div class="row">
   		<div class="col-twelve">

   			<article class="format-standard">  

                @yield('content')

	  			   

				</article>
   		

		</div> <!-- end col-twelve -->
   	</div> <!-- end row -->

		<div class="comments-wrap">
			<div id="comments" class="row">
				<div class="col-full">
                @if(session('commentSubmit'))
                    <div class="alert alert-success">
                        {{session('commentSubmit')}}
                    </div>
                @endif
               <h3>{{count($comments)}} Comments</h3>

               <!-- commentlist -->
               <ol class="commentlist">

                  

                @yield('comments')

                 
               </ol> <!-- Commentlist End -->					

                @if(Auth::check())
                <!-- respond -->
                <div class="respond">

                    <h3>Leave a Comment</h3>

                    <form name="contactForm" id="contactForm" method="post" action="{{route('comments.store')}}">
                    @csrf
                        <fieldset>
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="message form-field">
                                <textarea name="commentText" id="cMessage" class="full-width" placeholder="Your Message" ></textarea>
                            </div>

                            <button type="submit" class="submit button-primary">Submit</button>
                            @error('commentText')
                                {{$message}}
                            @enderror
                        </fieldset>
                    </form> <!-- Form End -->

                    </div> <!-- Respond End -->
                @endif
         	</div> <!-- end col-full -->
         </div> <!-- end row comments -->
		</div> <!-- end comments-wrap -->

   </section> <!-- end content -->

   
    @include('fixed.global.footer')

   <!-- Java Script
   ================================================== --> 
   @include('fixed.global.scripts')
   
</body>

</html>