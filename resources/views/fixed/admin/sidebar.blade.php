<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
       
        <div class="sidebar-brand-text mx-3">Go to Home page</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Dashboard')
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
           
          @endif
        @endforeach
      @endforeach
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Posts')
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Posts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Posts</h6>
            <a class="collapse-item" href="{{route('post.create')}}">Create Post</a>
            <a class="collapse-item" href="{{route('post.index')}}">View All Posts</a>
            <a class="collapse-item" href="{{route('comments.index')}}">View All Comments</a>
          </div>
        </div>
      </li>
      @endif
        @endforeach
      @endforeach
    

    
      @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Categories')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Categories</span>
        </a>
        <div id="categories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Posts</h6>
          
            <a class="collapse-item" href="{{route('categories.index')}}">View All Categories</a>
          </div>
        </div>
      </li>
      @endif
        @endforeach
      @endforeach

      @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Socials')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#socials" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Socials</span>
        </a>
        <div id="socials" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Posts</h6>
          
            <a class="collapse-item" href="{{route('socials.index')}}">View All Socials</a>
          </div>
        </div>
      </li>
      @endif
        @endforeach
      @endforeach
      
      @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Users')
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-cog"></i>
              <span>Users</span>
            </a>
            <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users</h6>
                <a class="collapse-item" href="{{route('users.index')}}">View All Users</a>
              </div>
            </div>
          </li>
          @endif
        @endforeach
      @endforeach

      @foreach(auth()->user()->roles->slice(0,1) as $role)
        @foreach($role->permissions as $permission)
          @if($permission->name == 'View Authorization')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Authorization</span>
        </a>
        <div id="collapseRoles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Roles</h6>
            <a class="collapse-item" href="{{route('permissions.index')}}">View All Permissions</a>
            <a class="collapse-item" href="{{route('roles.index')}}">View All Roles</a>
          </div>
        </div>
      </li>
     
      @endif
        @endforeach
      @endforeach


    
      <!-- Divider -->
      <hr class="sidebar-divider">

    
    </ul>