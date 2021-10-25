<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Models\Comment;
use App\Models\Post;
class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['comments'] = Comment::all();
        return view('admin.comments.index',$this->data);
    }
    public function filterPostComments(Post $post,Request $request){
        
        $this->data['comments'] = Comment::with(['post'])->where('post_id','=',$post->id)->get();
  
        return view('admin.comments.index',$this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                'commentText'=>'required|min:10|max:255'
            ]);
            \DB::beginTransaction();
            $user = Auth::user();
    
            $comment = new Comment;
            $comment->post_id = $request->post_id;
            $comment->author = $user->name;
            $comment->commentText = $request->commentText;
            $comment->commentUsername = $user->username;
            $comment->save();
            \DB::commit();
            // dd($request->all());
            
            $request->session()->flash('commentSubmit', 'Your comments has been submited');
    
            return redirect()->route('post', $request->post_id);
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('post', $request->post_id);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment, Request $request)
    {
        //
        try{
            \DB::beginTransaction();
            $comment->is_active = $request->is_active;
            $comment->save();
            \DB::commit();
            return redirect()->route('comments.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('comments.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, Request $request)
    {
        try{
            \DB::beginTransaction();
            $comment->delete();
            \DB::commit();
            $request->session()->flash('messageDeleted','Comment was deleted');
            return redirect()->route('comments.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('comments.index');
        }
    }
}
