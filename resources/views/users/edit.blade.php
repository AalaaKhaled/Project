@extends('layouts.app')
@section('title', 'Edit')
@section('content')



 <div class="container col-6" >
  
  @if(session('errmsg'))
  <div class="alert alert-danger" role="alert">
 {{session('errmsg')}}
</div>
  @endif
<form class="text-center border border-light p-5" action="{{route('users.update',Auth::id())}}"  method="POST"style="background: white" enctype="multipart/form-data">
  @csrf
  @method('PUT')
 <div >
    <div >
      @if($user->avatar)
     <img src=" {{ asset('/storage/images/'. Auth::user()->avatar) }}" style="margin-right: 20px" class="avatar img-circle rounded-circle float-left" name="image" alt="avatar" width="60px" height="60px">
      @else
      <img src="{{asset('/storage/default/defaultUser.jpg')}}"  style="margin-right: 20px" class="avatar img-circle rounded-circle float-left"   alt="avatar" width="60px" height="60px">
      @endif
     <!--<input type="file" class="form-control float-left">-->
     </div>

  <div style="text-align: left;padding-top: 13px">
    <p style="display: inline;font-size: 20px">{{$user->username}}</p>
   <!-- <p><a style="color: rgb(51,181,229);font-weight: bold; ">Change Profile Photo</a></p>-->
  </div>
  <br>
    <div class="input-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="image">
    <label id="file-upload-filename" class="custom-file-label" for="inputGroupFile04"style="color: rgb(51,181,229);font-weight: bold; margin-top: 10px;text-align: center;">Change Profile Photo</label>
  </div>
</div>

 </div>
 <br>
  <div class="form-group row">
    <!-- Default input -->
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}">
    </div>
  </div>

  <div class="form-group row">
    <!-- Default input -->
    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Username" name="username" value="{{ $user->username }}">
    </div>
  </div>

  <div class="form-group row">
    <!-- Default input -->
    <label for="inputEmail3" class="col-sm-2 col-form-label">Website</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Website"  name = "website" value="{{ $user->website }}">
    </div>
  </div>

  <div class="form-group row">
  <label for="exampleFormControlTextarea3" class="col-sm-2 col-form-label">Bio</label>
  <div class="col-sm-10">
  <textarea class="form-control" id="exampleFormControlTextarea3" rows="3"  name = "bio" placeholder="Bio">{{ $user->bio }}</textarea>
  </div>
  </div>

<div class="form-group row">
    <!-- Default input -->
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" name = "email" placeholder="Email" value="{{ $user->email }}">
    </div>
  </div>

  <div class="form-group row">
    <!-- Default input -->
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
    </div>
  </div>
  <div class="form-group row">
    <!-- Default input -->
    <label for="inputPassword3" class="col-sm-2 col-form-label">Change Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="New Password" name="newpassword">
    </div>
  </div>
  <div class="form-group row">
    <!-- Default input -->
    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm New Password" name ="confirmPassword">
    </div>
  </div>

  <div class="form-group row">
    <!-- Default input -->
    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="phone" value=" {{$user->phone}}"placeholder="Phone" >
    </div>
  </div>
  <div  class="form-group row">
     <label class="col-sm-2 col-form-label">Gender</label>
     <div class="col-sm-10">
    <select name="gender" class="browser-default custom-select mb-4">
        <option value="" disabled {{empty($user->gender)?'selected':''}} >Gender</option>
        <option value="male" {{!empty($user->gender=='male')?'selected':''}} >Male</option>
        <option value="female" {{!empty($user->gender=='female')?'selected':''}}>Female</option>

    </select>
    </div>
  </div>

   <div class="form-group row" >
    <button type="submit" class="btn btn-primary">Edit Profile</button>
 </div>
  <!-- <div class="form-group row" style="position: relative;">   
    <a style="color: rgb(51,181,229);font-weight: bold;" class="bottom-align-text">Temporarily disable my account</a>
  </div> -->
</form>

</div>

@endsection