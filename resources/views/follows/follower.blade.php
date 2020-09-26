@extends('layouts.app')
@section('title', 'Post')
@section('content')


  <div class="container col-5">
  <div class="card">
    

  <div class="card-body">
   <H2>Follower : </H2>
   <hr>
   @if($followerList->isEmpty())
    <p>Follower</p>
   @else
    @foreach($followerList as $follower)
   <div class="row"> 
    <div  class="col-2">
       @if($follower->avatar)
      <img src="{{asset('/storage/images/'.$follower->avatar)}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px"><!-- user img-->
       @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px">
      @endif
     
     </div>

  <div style="text-align: left" class="col-6">
    <p style="display: inline;font-weight: bold">{{$follower->username}}</p><!-- username-->
    <p>{{$follower->name}}</p><!--name-->

  </div>
  <div class="col-4">
    
      @if(in_array($follower->id,$follow))
     <a  href="{{route('follows.follow',$follower->id)}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px;width: 130px">Unfollow</a>
     @else
      @if($follower->id != Auth::id() && in_array($follower->id,$followerUserList))
       <a href="{{route('follows.follow',$follower->id)}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px;width: 130px">Follow Back</a>
      @elseif($follower->id != Auth::id())
      <a href="{{route('follows.follow',$follower->id)}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px;width: 130px">Follow</a>
     
      @endif
     @endif

     
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