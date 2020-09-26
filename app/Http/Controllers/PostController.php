<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Storage;
class PostController extends Controller
{
    
     public function create(){
        
         return view('posts.create');
     }
     public function store(Request $request){
        $validateData = $request->validate([
             'postimage'=>'required|image',
            'description' =>'required|max:1000'
        ]);
         
        if ($request->hasFile('postimage')) {
        $filename = $request->postimage->getClientOriginalName();
        $request->postimage->storeAs('postImages',$filename,'public');
        $user=Auth::user();
        $user->posts()->save(new Post(['description'=>$request->description,'published_at'=>now(),'postimage'=>$filename]));
        }else{
            dd($request);
        }
         return redirect(route('users.show',Auth::id()));
        
     }
      
     public function edit($id){
         $post=Post::find($id);
         return view('posts.edit',['id'=> $post->id])->with('post', $post);
     }
     public function update(Request $request,$id){
         //dd($request->all());
        
        $post = Post::find($id);
        $post->update(['description'=>$request->description]);
           if ($request->hasFile('postimage')) {
        $filename = $request->postimage->getClientOriginalName();
        $this->deleteOldImage($filename);
        $request->postimage->storeAs('postImages',$filename,'public');
        //User::find(1)->update(['avatar'=>$filename]); 
        $post->update( ['postimage'=>$filename]); 
    }
        // return redirect(route('posts.edit', $request->id));
         return redirect(route('users.show',Auth::id()));

         //return view('users.update',['id'=> 1]);
     }

     protected function deleteOldImage($filename){
        if($filename){
            Storage::delete('/public/images/'.$filename);
        }
    }

     public function destroy($id){
             $post = Post::find($id);

            // delete related   
            $post->saves()->delete();
            $post->comments()->delete();
            $post->likes()->delete();

            $post->delete();
        // Post::where('id',$id)->delete();

         return redirect(route('users.show',Auth::id()));
         //return redirect()->back()->with('id',Auth::id());
         
     }

      public function show($id){
        //liked
         $isLike=false;
         $postsLiked  = array();
         $UserLike =Auth::user()->likes->all();
         for ($i=0; $i <count($UserLike) ; $i++) { 
          if (!is_null($UserLike[$i]['post_id'])){
            array_push($postsLiked, $UserLike[$i]['post_id']);
            }
         }
         
         if(in_array($id,$postsLiked)){
            $isLike=true;
         }else{
             $isLike=false;
         }

         //saved

         $issave=false;
         $saveList = array();
         $UserSave =Auth::user()->saves->all();
         for ($i=0; $i <count($UserSave) ; $i++) { 
          if (!is_null($UserSave[$i]['post_id'])){
            array_push($saveList, $UserSave[$i]['post_id']);
            }
         }
         
         if(in_array($id,$saveList)){
            $issave=true;
         }else{
             $issave=false;
         }
         try {
        $post= Post::findOrFail($id);
        $user = Post::findOrFail($id)->user;
        }catch(ModelNotFoundException $e)
            {
                dd(get_class_methods($e)); // lists all available methods for exception object
                dd($e);
            }
        return view('posts.show',['id'=>$id])->with('post',$post)->with('user',$user)->with('isLike',$isLike)->with('issave',$issave);
    }
}
