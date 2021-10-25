<!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            
            <form action="{{route('home.search')}}" method="post">
              @csrf
              @method('get')
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search for...">
                <input type="submit" id="submit" name="submit" value="Search">
               
                </div>
                @error('search')
                  {{$message}}
                @enderror
            </form>
           
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            @foreach($categories as $category)
              <div class="d-flex">
                <a href="{{route('home.filter',$category->id)}}">{{$category->name}}</a>
              </div>
              
            @endforeach
            
            </div>
          </div>
        </div>
