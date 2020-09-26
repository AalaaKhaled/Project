<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;


class UserController extends Controller
{
     
    public function create(){
        return view('users.create');
    }
    public function store(Request $request){
        //dd($request->all());
        User::create(['name'=>$request->name,'email'=>$request->email,'password'=>$request->password]);
        return redirect(route('users'));
      
    }
    public function edit($id){
        $user=User::find($id);
        return view('users.edit',['id'=> $user->id])->with('user', $user);
     
    }
    public function update(Request $request,$id){

       // dd($request->all());
       if(is_null($request->newpassword)){
        if(!is_null($request->password))return back()->with('errmsg',"Invalid"); 
         User::find($id)->update(['name'=>$request->name,'username'=>$request->username,'email'=>$request->email,'bio'=>$request->bio,'website'=>$request->website,'phone'=>$request->phone,'gender'=>$request->gender]);
        if ($request->hasFile('image')) {
        $filename = $request->image->getClientOriginalName();
        $this->deleteOldImage();
        $request->image->storeAs('images',$filename,'public');
        //User::find(1)->update(['avatar'=>$filename]); 
        auth()->user()->update( ['avatar'=>$filename]); 
         }
       // return redirect()->back();
        return redirect(route('users.show',['id'=> $request->id]));
       }else{
        
        $hasedPassword = Auth::user()->password;
        if(Hash::check($request->password,$hasedPassword)){
          if($request->newpassword == $request->confirmPassword){
           User::find($id)->update(['name'=>$request->name,'username'=>$request->username,'email'=>$request->email,'password'=>Hash::make($request->newpassword),'bio'=>$request->bio,'website'=>$request->website,'phone'=>$request->phone,'gender'=>$request->gender]);
           if ($request->hasFile('image')) {
        $filename = $request->image->getClientOriginalName();
        $this->deleteOldImage();
        $request->image->storeAs('images',$filename,'public');
        //User::find(1)->update(['avatar'=>$filename]); 
        auth()->user()->update( ['avatar'=>$filename]); 
         }
       // return redirect()->back();
        Auth::logout();
        return redirect()->route('login')->with('msg',"password changed");
        }else{
          return back()->with('errmsg',"Enter Password Correctly");
        }
        }else{
          return back()->with('errmsg',"Please Enter The Old Password Correctly");
        }
       }

      
    }

    protected function deleteOldImage(){
        if(auth()->user()->avatar){
            Storage::delete('/public/images/'.auth()->user()->avatar);
        }
    }

    public function destroy($id){
        USer::where('id',$id)->delete();
        return redirect(route('users',['id'=> $id]));
        //return view('users.destroy',['id'=> 1]);
    }
    public function show($id){
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
         }else{
             $followState="Follow";
           }
        $posts= User::find($id)->posts;
        $user = User::find($id);
        return view('users.show',['id'=>$id])->with('posts',$posts)->with('user',$user)->with('followState',$followState);
    }

   
    

    
}
