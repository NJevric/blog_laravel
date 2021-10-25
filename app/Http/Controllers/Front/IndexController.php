<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests\searchRequest;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Pagination\Pagination;
use Illuminate\Support\Facades\DB;


class IndexController extends OsnovniController
{
  
    const POSTS_LIMIT = 6;
   
    public function index()
    {
       
        $this->data['posts'] = DB::table('posts')  
            ->select('posts.title','posts.post_image','posts.content','posts.id','categories.name','posts.created_at')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->orderBy('id','desc')
            ->paginate(self::POSTS_LIMIT);

        return view('home', $this->data);


    }

    public function filterByCategory(Category $category){
        
        $this->data['posts'] = DB::table('posts')  
            ->select('posts.title','posts.post_image','posts.content','posts.id','categories.name','posts.created_at')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('categories.name', '=', $category->name)
            ->orderBy('id','desc')
            ->paginate(self::POSTS_LIMIT);

        return view('home', $this->data);
    }
    
    public function search(SearchRequest $request){
       
        $this->data['posts'] = DB::table('posts')  
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('posts.title', 'LIKE', '%'.$request->search.'%')
            ->orderBy('id','desc')
            ->paginate(self::POSTS_LIMIT);
        // $this->data['posts'] = Post::where('title','like','%'.$request->search.'%')->paginate(self::POSTS_LIMIT);
        // dd($this->data['posts']);
        // dd($request->search);
        return view('home', $this->data);
    }
}
