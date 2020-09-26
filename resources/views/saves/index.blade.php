 @extends('layouts.app')
@section('title', 'Profile')
@section('content')


 <div class="container col-8" style="background: white">
 <h1>Save Items</h1>
 <hr>
@foreach($saves->chunk(3) as $chunk)

 <div class="row">
        @foreach($chunk as $saved)
    <div class="col-lg-4">
         <a href="{{route('posts.show',$saved->post_id)}}"> <img class="img-responsive" src="{{asset('/storage/postImages/'.$saved->post->postimage)}}" width="240" height="240" /><a>
    </div>
     @endforeach
    
  </div>
<br>
@endforeach

</div>




@endsection