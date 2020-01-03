@extends('tweets.app')
@section('content')
    <div class="container m-5">
        <h1>Post Info :</h1>
        <h5>Title : {{$tweet->title}}</h5>
        <h5>Description : {{$tweet->description}}</h5>
    </div>
@endsection
