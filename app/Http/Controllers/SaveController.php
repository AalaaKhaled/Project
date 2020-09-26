<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Save;

class SaveController extends Controller
{

	public function index(){
	   $saves = Auth::user()->saves;
       //dd($saves);
       return view('saves.index')->with('saves', $saves);

	}

    public function saved($id){//postid
      
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
     	 	  Save::where([
     	 	  	['post_id',$id],
     	 	  	['user_id',Auth::id()]
     	 	  ])->delete();
     	 	  return back();
     	 }else{
     	 	 $issave=false;
     	 	 Save::create(['published_at'=>now(),'user_id'=> Auth::id(),'post_id'=>$id]);//save()
     	 	 return back();
     	 }
      
    }
}
