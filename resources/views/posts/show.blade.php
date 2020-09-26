@extends('layouts.app')
@section('title', 'Post')
@section('content')


  <div class="container col-5">
  <div class="card">
    <div >
    <div >
       @if($user->avatar)
      <img src="{{ asset('/storage/images/'.$user->avatar) }}" style="margin-right: 20px;margin-top: 10px;margin-left: 10px" class="avatar img-circle rounded-circle float-left" alt="avatar" width="50px" height="50px">
       @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px">
      @endif
    
      <div class="dropdown" style="margin-right: 20px;margin-top: 10px">
        <button class="btn btn-default  float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-ellipsis-v fa-rotate-90 float-right" style="font-size: 30px"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          @if($user->id == Auth::id())
          <a class="dropdown-item" href="{{route('posts.destroy',$post->id)}}">
            <form action="{{route('posts.destroy',['id'=>$post->id])}}" method="POST" style="display:inline;">
             @csrf
             @method('DELETE')
             
             <button  class="btn btn-link" style="color: black;text-decoration: none;padding-left: 0px" type="submit">Delete</button>
            </form>
          </a>
          <a class="dropdown-item" href="{{route('posts.edit',$post->id)}}">Edit</a>
         @endif
          <a class="dropdown-item" href="#">Report</a>
        </div>
      </div>
     <!--<input type="file" class="form-control float-left">-->
     </div>

  <div style="text-align: left;margin-top: 20px">
    <p style="display: inline;">{{$user->username}}</p>
  </div>
 
 </div>

  <img src="{{ asset('/storage/postImages/'.$post->postimage)}}" class="card-img-top" alt="postImage" height="500px"style="margin-top: 10px">
  <div class="card-body">
  
      <div style="margin-bottom: 5px">
   
       <a name="like" href="{{route('likes.liked',$post->id)}}" style="text-decoration: none">
         @if($isLike)
       <i class="fa fa-heart"style="margin-right: 10px;font-size: 29px;color: red"></i>
         @else
         <i class="fa fa-heart-o"style="margin-right: 10px;font-size: 29px;color: black"></i>
         @endif
       </a>
        <a href="{{route('comments.show',$post->id)}}" style="text-decoration: none;color: black"><i class='fa fa-comment-o' style="font-size: 30px"></i></a>

        <a href="{{route('saves.saved',$post->id)}}" style="text-decoration: none">
           @if($issave)
              <i class="fa fa-bookmark float-right" style="font-size: 30px;color: black"></i>
            @else
              <i class="fa fa-bookmark-o float-right" style="font-size: 30px;color: black"></i>
            @endif
        </a>
     </div>
     <p style="margin-bottom: 3px"><span>{{$post->likes()->count()}}</span> Likes</p>
    <p class="card-title" style="font-weight: bold;margin-bottom: 3px">{{$user->username}}</p>
    <p >{{$post->description}}</p>
    <a href="{{route('comments.show',$post->id)}}" style="text-decoration: none;color: #808080"><p class="card-text">View All <span>{{$post->comments()->count()}}</span> Comments</p></a> 
    <hr>
     <div>
     <form action="{{route('comments.store')}}" method="POST">
      @csrf
      <div class="form-row align-items-center">
    <div class="col-10">
      <!--<label class="sr-only" for="inlineFormInput">Name</label>-->
      <input name="post_id" value="{{$post->id}}" type="hidden">
      <input type="text" class="form-control mb-2" id="inlineFormInput"  name="comment" placeholder="Add a comment..."style="border: none;outline:none; box-shadow: none">
    </div>
  
    <div class="col-2">
      <button type="submit" class="btn btn-link mb-2" style="color: rgb(51,181,229);text-decoration: none;font-weight: bold;">Post</button>
    </div>
  </div>
</form>
    </div>
   
    </div>
   </div>

   <br><br>


  </div>




@endsection