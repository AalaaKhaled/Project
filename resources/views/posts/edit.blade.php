@extends('layouts.app')
@section('title', 'Edit')
@section('content')
<div class="container col-6">
<form class="text-center border border-light p-5" action="{{route('posts.update',['id'=>$post->id])}}" method="POST"style="background: white" enctype="multipart/form-data">
   @csrf
   @method('PUT')
  <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="postimage">
          <label id="file-upload-filename" class="custom-file-label" for="inputGroupFile04"style="color: rgb(51,181,229);font-weight: bold; margin-top: 10px;text-align: center;">Selected Photo : {{$post->postimage}}</label>
        </div>
      </div>
    <br><br>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control"  name="description"  id="exampleFormControlTextarea1" rows="3">{{$post->description}}</textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Edit Post</button>
</form>
</div>
@endsection

  
   