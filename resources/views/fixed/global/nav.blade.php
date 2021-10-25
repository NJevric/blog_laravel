

  <div class="row header-content">

<div class="logo">
<a href="{{route('home')}}"><img src="{{asset('images/cubes-solid.svg')}}" alt="Home"></a>
 </div>

<nav id="main-nav-wrap">
 <ul class="main-navigation sf-menu">
          @if(Auth::check())
             
            @foreach($menuLogged as $link)
              <li class="nav-item @if(request()->routeIs($link->route)) active @endif">
                <a class="nav-link" href="{{ route($link->route) }}">{{ $link->name }}</a>
              </li>
            @endforeach
          @else
            @foreach($menu as $link)
              <li class="nav-item @if(request()->routeIs($link->route)) active @endif">
                <a class="nav-link" href="{{ route($link->route) }}">{{ $link->name }}</a>
              </li>
            @endforeach
          @endif
					
 </ul>
</nav> <!-- end main-nav-wrap -->

<div class="search-wrap">
 
 <form role="search" method="post" class="search-form" action="{{route('home.search')}}">
   @csrf
   @method('get')
   <label>
     <span class="hide-content">Search for:</span>
     <input type="search" class="search-field" placeholder="Type Your Keywords" value="" name="search" title="Search for:" autocomplete="off">
   </label>
   <input type="submit" class="search-submit" value="Search">
 </form>

 <a href="#" id="close-search" class="close-btn">Close</a>

</div> <!-- end search wrap -->	

<div class="triggers">
 <a class="search-trigger" href="#"><i class="fa fa-search"></i></a>
 <a class="menu-toggle" href="#"><span>Menu</span></a>
</div> <!-- end triggers -->	

</div>     	