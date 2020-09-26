<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{ /*
    public function index($id) {
        $post= Post::find($id);
        $comments = Post::find($id)->comments;
         
         return view('comments.index')->with('post',$post)->with('comments',$comments);//user img name comment
         //->with('posts', $posts);
     }*/
     public function store(Request $request){//postId
       //dd($request->all());
     	$validateData = $request->validate([
             'comment'=>'required',
            
        ]);
      Comment::create(['comment'=>$request->comment,'published_at'=>now(),'user_id'=> Auth::id(),'post_id'=>$request->post_id]);//save()
       /* $user=Auth::user();
        $user->comments()->save(new Comment(['comment'=>$request->comment,'published_at'=>now(),'post_id'=>$request->post_id]));*/
       
        return back();
      
    }
      
     public function show($id){//postId
        //$post= Post::find($id);
        $comments = Post::find($id)->comments;
        return view('comments.index',['id'=>$id])->with('comments',$comments)->with('id',$id);
    }
    
    public function destroy($id){
         Comment::where('id',$id)->delete();
         return back();
         //return redirect()->back()->with('id',Auth::id());
         
     }
}
