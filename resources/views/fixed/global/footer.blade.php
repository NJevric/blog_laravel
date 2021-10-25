 <!-- footer
   ================================================== -->
   <footer>

   	<div class="footer-main">

   		<div class="row">  

	      	

	      	<div class="col-twelve tab-full mob-1-2 social-links">

	      		<h4>Social</h4>

	      		<ul>
					@foreach($socials as $social)
						<li><a href="{{$social->href}}">{{$social->text}}</a></li>
					@endforeach
				</ul>
	      	           	
	      	</div> <!-- end social links --> 

	      
	      </div> <!-- end row -->

   	</div> <!-- end footer-main -->

      <div class="footer-bottom">
      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright Abstract 2016</span> 
		         	<span>Design by <a href="http://www.styleshout.com/">styleshout</a></span>	
                     <span>Student Nikola Jevric 78/18</span>	  
                     <a href="{{asset('documentation.pdf')}}" target="__blank">Documentation</a>       	
		         </div>

		         <div id="go-top">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon icon-arrow-up"></i></a>
		         </div>         
	      	</div>

      	</div> 
      </div> <!-- end footer-bottom -->  

   </footer>  

   <div id="preloader"> 
    	<div id="loader"></div>
   </div> 