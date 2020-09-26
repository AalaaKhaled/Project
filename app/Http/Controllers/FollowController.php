<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class FollowController extends Controller
{
     public function followU($id){//userId
      $followState="Follow";
      $following  = array();
      $UserFollowing = Auth::user()->following->all();
      for ($i=0; $i <count($UserFollowing) ; $i++) { 
          if (!is_null($UserFollowing[$i]['id'])){
            array_push($following, $UserFollowing[$i]['id']);
            }
         }
      if(in_array($id,$following)){
            $followState="Unfollow";
            auth()->user()->following()->wherePivot('user_id',$id)->detach(); 
            //auth()->user()->following()->where([['user_id',$id],['follower_id',Auth::id()]])->detach(); 
            //dd(auth()->user()->following()->where([['user_id',$id],['follower_id',Auth::id()]]));
            return back()->with('followState',$followState);
         }else{
             $followState="Follow";
             auth()->user()->following()->attach(User::find($id));
             return back()->with('followState',$followState);

         }

    }

    public function follower($id){
      $followState="Follow";
      $follow  = array();
      $UserFollowing = Auth::user()->following->all();
      for ($i=0; $i <count($UserFollowing) ; $i++) { 
          if (!is_null($UserFollowing[$i]['id'])){
            array_push($follow, $UserFollowing[$i]['id']);
            }
         }
       $followerUserList = array();
       $UserFollower = Auth::user()->follower->all();
      for ($i=0; $i <count($UserFollower) ; $i++) { 
          if (!is_null($UserFollower[$i]['id'])){
            array_push($followerUserList, $UserFollower[$i]['id']);
            }
         }
          
       $followerList = User::find($id)->follower;

       return view('follows.follower')->with('followerList',$followerList)->with('follow',$follow)->with('followerUserList',$followerUserList);
    }


    public function following($id){
        $followState="Follow";
      $follow  = array();
      $UserFollowing = Auth::user()->following->all();
      for ($i=0; $i <count($UserFollowing) ; $i++) { 
          if (!is_null($UserFollowing[$i]['id'])){
            array_push($follow, $UserFollowing[$i]['id']);
            }
         }

       $followingList = User::find($id)->following;
       return view('follows.following')->with('followingList',$followingList)->with('follow',$follow);
    }
}
