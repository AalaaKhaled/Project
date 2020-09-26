<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postList=array();
        $subarr = array();
        $followingList=Auth::user()->following;
        foreach ($followingList as $value) {
        $subarr = $value->posts->all();
        $postList = array_merge($postList,$subarr);
        }
       
        usort($postList, function($a, $b) {
         return $b['published_at'] <=> $a['published_at'];
        });
         //dd($postList);
      
         $postsLiked  = array();
         $UserLike =Auth::user()->likes->all();
         for ($i=0; $i <count($UserLike) ; $i++) { 
          if (!is_null($UserLike[$i]['post_id'])){
            array_push($postsLiked, $UserLike[$i]['post_id']);
            }
         }
         //saved
          $save=false;
         $saveList = array();
         $UserSave =Auth::user()->saves->all();
         for ($i=0; $i <count($UserSave) ; $i++) { 
          if (!is_null($UserSave[$i]['post_id'])){
            array_push($saveList, $UserSave[$i]['post_id']);
            }
         }
         
         
        return view('home')->with('postList',$postList)->with('postsLiked',$postsLiked)->with('saveList',$saveList);
    }
}
