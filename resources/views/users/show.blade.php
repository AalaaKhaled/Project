@extends('layouts.app')
@section('title', 'Profile')
@section('content')


 <div class="container col-7">

   <div class="row">
    <div  class="col-4">
      @if($user->avatar)
     <img src=" {{ asset('/storage/images/'.$user->avatar) }}" style="margin-right: 100px" class="avatar img-circle rounded-circle float-left" alt="avatar" width="150px" height="150px">
     @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}" style="margin-right: 100px" class="avatar img-circle rounded-circle float-left" alt="avatar" width="150px" height="150px">
      @endif
     <!--<input type="file" class="form-control float-left">-->
     </div>
     <div  class="col-8">
     <div style="text-align: left;">
    <p style="display: inline;font-size: 27px">{{$user->username}}</p>
    @if($user->id == Auth::id())
   <a  href="{{route('users.edit',Auth::id())}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px">Edit Profile</a>
    @else
    <a  href="{{route('follows.follow',$user->id)}}" class="btn btn-outline-secondary" style="padding: 7px;margin-left: 25px">{{$followState}}</a>
    @endif
  <a href="{{route('saves.index')}}"><i class="fa fa-bookmark float-right" style="color: black;font-size: 30px"></i></a>
 </div>
   <div style="margin-top: 20px">
   <P style="display: inline;padding-right: 30px"><span style="font-weight: bold;">{{$user->posts()->count()}}</span> posts</P>
   <a href="{{route('follows.follower',$user->id)}}" style="display: inline;color:black;padding-right: 30px;text-decoration: none"><span style="font-weight: bold;">{{$user->follower()->count()}}</span> followers</a>
   <a href="{{route('follows.following',$user->id)}}" style="display: inline;color:black;padding-right: 30px;text-decoration: none"><span style="font-weight: bold;">{{$user->following()->count()}}</span> following</a>
   </div>
   <p style="margin-top: 25px;font-weight: bold;margin-bottom: 2px">{{$user->name}}</p>
   <pre style="margin-bottom: 2px">{{$user->bio}}</pre>
 <a href="http://{{$user->website}}" style="color:#00376b;text-decoration: none;font-weight:600; ">{{$user->website}}</a>

 </div>
  </div>
  <br>
 <hr>
@foreach($posts->chunk(3) as $chunk)

 <div class="row">
  @foreach($chunk as $post)
    <div class="col-lg-4">
         <a href="{{route('posts.show',$post->id)}}"> <img class="img-responsive" src="{{asset('/storage/postImages/'.$post->postimage)}}" width="240" height="240" /><a>
    </div>
 
      @endforeach
  </div>
<br>
@endforeach


</div>




@endsection