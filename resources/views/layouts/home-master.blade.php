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
   <section id="bricks">
 
   	<div class="row masonry">
       
   		<!-- brick-wrapper -->
         <div class="bricks-wrapper">

         	<div class="grid-sizer"></div>
           
         	<div class="brick entry featured-grid animate-this">
         		<div class="entry-content">
         			<div id="featured-post-slider" class="flexslider">
			   			<ul class="slides">

				   			
							@yield('categories')
				   		

				   		</ul> <!-- end slides -->
				   	</div> <!-- end featured-post-slider -->        			
         		</div> <!-- end entry content -->         		
         	</div>

             @yield('content')


         </div> <!-- end brick-wrapper --> 

   	</div> <!-- end row -->

   	<div class="row">
   		
   		<nav class="pagination">
		     @yield('pagination')
	      </nav>

   	</div>

   </section> <!-- end bricks -->

   
    @include('fixed.global.footer')

   <!-- Java Script
   ================================================== --> 
   @include('fixed.global.scripts')
   
</body>

</html>