@extends('layouts.app')
@section('title', 'Create Post')
@section('content')

<div class="container col-6">
  <form class="text-center border border-light p-5" action="{{route('posts.store')}}" method="POST" style="background: white" enctype="multipart/form-data">
   @csrf
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="postimage">
          <label id="file-upload-filename" class="custom-file-label" for="inputGroupFile04"style="color: rgb(51,181,229);font-weight: bold; margin-top: 10px;text-align: center;">Select Photo</label>
        </div>
      </div>
    <br><br>
     <div class="form-group">
      <label for="exampleFormControlTextarea1">Description</label>
      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Add Post</button>
    </form>
  </div>


@endsection