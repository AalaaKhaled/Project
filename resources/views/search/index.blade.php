@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<div class="container col-5">
  <div class="card">
    

  <div class="card-body">
   <H2>Results : </H2>
   <hr>
   @if($users->isEmpty())
    <p>No Results</p>
   @else
    @foreach($users as $user)
   <div class="row"> 
    <div  class="col-2">
       @if($user->avatar)
      <img src="{{asset('/storage/images/'.$user->avatar)}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px"><!-- user img-->
       @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px">
      @endif
     
     </div>

  <div style="text-align: left" class="col-10">
    <a href="{{route('users.show',$user->id)}}" style="text-decoration: none;color: black"><p style="display: inline;font-weight: bold">{{$user->username}}</p></a><!-- username-->
    <p>{{$user->name}}</p><!--name-->

  </div>
  
  
 </div>
 <br>
 @endforeach 
@endif
   
    </div>
   </div>

   <br><br>


  </div>




@endsection

