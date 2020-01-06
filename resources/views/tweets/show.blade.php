@extends('layouts.app')
@section('content')
    <div class="container m-5">
        <h1>Post Info :</h1>
        <h5>Title : {{$tweet->title}}</h5>
        <h5>Description : {{$tweet->description}}</h5>
        <h5>Comments :
            @foreach($tweet->comments as $comment)
              <h6>{{$tweet->user->name}}  :  {{$comment->body}}</h6>
            @endforeach
        </h5>
        <h5>Tags :
            @foreach($tweet->tags as $tag)
                <h6> {{$tag->name}}</h6>
            @endforeach
        </h5>
    </div>
    <form action="{{ route('tweets.comment', $tweet->id) }}" method="POST" name="comment_tweet" class="m-5" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Comment</strong>
                    <textarea class="form-control" col="4" name="body" placeholder="Enter Comment"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Comment</button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger m-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </form>
@endsection
