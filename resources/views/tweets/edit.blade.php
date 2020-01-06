@extends('layouts.app')
@section('content')
    <form action="{{ route('tweets.update', $tweet->id) }}" method="POST" name="update_tweet" class="m-5" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Title</strong>
                    <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ $tweet->title }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Description</strong>
                    <textarea class="form-control" col="4" name="description" placeholder="Enter Description" >{{ $tweet->description }}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Image</strong>
                    <img id="img" style="width: 100px" class="img-fluid" src="{{env('APP_URL').'/'.$tweet->image}}">
                    <input id="imgInput" type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <script>
        document.getElementById("img").setAttribute("src",document.getElementById("imgInput").value);
    </script>
@endsection
