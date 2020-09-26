@extends('layouts.app')
@section('title', 'Post')
@section('content')


  <div class="container col-5">
  <div class="card">
    

  <div class="card-body">
   <H2>Comments : </H2>
   <hr>
   @if($comments->isEmpty())
    <p>Add First Comment</p>
   @else
    @foreach($comments as $comment)
   <div class="row"> 
    <div  class="col-2">
       @if($comment->user->avatar)
      <img src="{{asset('/storage/images/'.$comment->user->avatar)}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px"><!-- user img-->
       @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px">
      @endif
     
     </div>

  <div style="text-align: left" class="col-9">
    <p style="display: inline;font-weight: bold">{{$comment->user->username}}</p><!-- username-->
    <p style="display: inline;margin-left: 10px;color: gray">{{ date('h:i:s A', strtotime($comment->published_at))}} </p>
    <p style="padding-right: 7px">{{$comment->comment}}</p><!-- comment-->
  </div>
  <div class="col-1">
     <div class="dropdown" style="margin-right: 20px;margin-top: 10px">
        <button class="btn btn-default  float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-ellipsis-v fa-rotate-90 float-right" style="font-size: 30px"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
           @if($comment->user->id == Auth::id())
          <a class="dropdown-item" href="{{route('comments.destroy',$comment->id)}}">
            <form action="{{route('comments.destroy',['id'=>$comment->id])}}" method="POST" style="display:inline;">
             @csrf
             @method('DELETE')
             
             <button  class="btn btn-link" style="color: black;text-decoration: none;padding-left: 0px" type="submit">Delete</button>
            </form>
          </a>
          @endif
          <a class="dropdown-item" href="#">Report</a>
        </div>
      </div>
  </div>
 </div>
 <br>
 @endforeach 
@endif
    <hr>
     <div>
     <form action="{{route('comments.store')}}" method="POST">
      @csrf
      <div class="form-row align-items-center">
    <div class="col-10">
     <!-- <label class="sr-only" for="inlineFormInput">Name</label>-->
      <input name="post_id" value="{{$id}}" type="hidden">
      <input type="text" class="form-control mb-2" id="inlineFormInput" name="comment" placeholder="Add a comment..."style="border: none;outline:none; box-shadow: none">
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