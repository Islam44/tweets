@extends('tweets.app')
@section('content')
    <form action="{{ route('tweets.update', $tweet->id) }}" method="POST" name="update_tweet" class="m-5">
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection