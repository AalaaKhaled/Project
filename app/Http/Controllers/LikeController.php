<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
//
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
//

class LikeController extends Controller
{  
   /*
    public function store(Request $request){
      
      Like::create(['published_at'=>now(),'user_id'=> Auth::id(),'post_id'=>$request->post_id]);//save()
      return back()->with('isLike',$isLike);
    }
     public function destroy($id){

        Like::where('id',$id)->delete();
        return back();
         //return redirect()->back()->with('id',Auth::id());
         
     }*/
     public function liked($id){//postid
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
     	 	  Like::where([
                ['post_id',$id],
                ['user_id',Auth::id()]
              ])->delete();
     	 	  return back()->with('isLike',$isLike);
     	 }else{
     	 	 $isLike=false;
     	 	 Like::create(['published_at'=>now(),'user_id'=> Auth::id(),'post_id'=>$id]);//save()
     	 	 return back()->with('isLike',$isLike);
     	 }
     	
     }
}
