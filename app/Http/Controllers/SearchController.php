<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\User;

class SearchController extends Controller
{
    public function index(){
    	$q = Request::input('q');
		 if($q != ' '){
		    $users = User::where('username','lIKE','%'.$q.'%')->orWhere('name','lIKE','%'.$q.'%')->get();
		    if (count($users) > 0) {
		    	//return view('welcome')->withDetails($user)->with('details',$user);
		    	return view('search.index')->with('users',$users);
		    }
		 }
		    	return view('search.index')->with('users',$users);
		 //dd($q);
    }
}
