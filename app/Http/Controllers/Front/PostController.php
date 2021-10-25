<?php

namespace App\Http\Controllers\Front;
use \Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Pagination;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
class PostController extends OsnovniController
{

 
    const POSTS_LIMIT = 5;


    public function index(){
        
        $user = Auth::id();
        $this->data['posts'] = Post::where('user_id','=',$user)->paginate(self::POSTS_LIMIT);
        $this->data['postsAllAdmin'] = Post::with(['category'])->paginate(self::POSTS_LIMIT);
        return view('admin.post.index',$this->data);
        
    }

    public function show(Post $post){
        
        $this->data['post'] = $post;
        $this->data['comments'] = DB::table('comments')
            ->join('posts', 'post_id', '=', 'posts.id')
            ->where('posts.id','=',$post->id)
            ->get();
        return view('post',$this->data);
  
    }

    public function create(){
        
        return view('admin.post.create',$this->data);
    }

    public function store(PostRequest $request){

        $id = Auth::id();
        try{
            \DB::beginTransaction();
            $post = new Post;

            if($file = $request->file('post_image')){
    
                $name = $file->getClientOriginalName();
                $file->move('images',$name);
                $post->user_id = $id;
                $post->post_image = $name;
                $post->title = $request->title;
                $post->content = $request->content;
                $post->category_id = $request->category;
            }
    
            $post->save();
            \DB::commit();
            $request->session()->flash('messageCreated','Post was crated');
            return redirect()->route('post.index');
        }
        catch(Exception $e){
            DB::rollback();
            $request->session()->flash('errorMessage','An error occurred please try again later');
            return redirect()->route('post.create');
        }
    }   

    public function edit(Post $post){
        $this->data['post'] = $post;
        return view('admin.post.edit',$this->data);
    }

    public function update(Post $post, PostUpdateRequest $request){

       
        $id = Auth::id();
        try{
            \DB::beginTransaction();
            if($file = $request->file('post_image')){

                $name = $file->getClientOriginalName();
                $file->move('images',$name);
                $post->post_image = $name;
               
            }
            $post->user_id = $id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->category_id = $request->category;

            $post->update();
            \DB::commit();
            $request->session()->flash('messageUpdate', 'Post was updated');
            return redirect()->route('post.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage','An error occurred please try again later');
            return redirect()->route('post.edit');
        }
    }
    public function destroy(Post $post, Request $request){
        try{
            \DB::beginTransaction();
            $post->delete();
            \DB::commit();

            $request->session()->flash('message', 'Post was deleted');
            return redirect()->route('post.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('post.index');
        }
      
    }
}
