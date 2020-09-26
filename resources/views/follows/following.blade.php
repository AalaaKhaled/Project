@extends('layouts.app')
@section('title', 'Post')
@section('content')


  <div class="container col-5">
  <div class="card">
    

  <div class="card-body">
   <H2>Following : </H2>
   <hr>
   @if($followingList->isEmpty())
    <p>Follow People Now</p>
   @else
    @foreach($followingList as $following)

   <div class="row"> 
    <div  class="col-2">
       @if($following->avatar)
      <img src="{{asset('/storage/images/'.$following->avatar)}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px"><!-- user img-->
       @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px">
      @endif
     
     </div>

  <div style="text-align: left" class="col-7">
    <p style="display: inline;font-weight: bold">{{$following->username}}</p><!-- username-->
    <p>{{$following->name}}</p><!--name-->

  </div>
  <div class="col-3">
    @if(in_array($following->id,$follow))
    <a  href="{{route('follows.follow',$following->id)}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px">Unfollow</a>
     @else
     @if($following->id != Auth::id())
     <a  href="{{route('follows.follow',$following->id)}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px">Follow</a>
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