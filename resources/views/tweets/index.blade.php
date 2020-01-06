@extends('layouts.app')
@section('content')
    <br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered m-5" id="laravel_crud">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Created By</th>
                    <th>Description</th>
                    <th>Created at</th>
                    <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tweets as $tweet)
                    <tr>
                        <td>{{ $tweet->id }}</td>
                        <td class="w-25"><img class="img-fluid w-50" src="{{env('APP_URL').'/'.$tweet->image}}"></td>
                        <td>{{ $tweet->title }}</td>
                        <td>{{ $tweet->slug }}</td>
                        <td>{{ $tweet->user['name'] }}</td>
                        <td>{{ $tweet->description }}</td>
                        <td>{{ date('Y-m-d', strtotime($tweet->created_at)) }}</td>
                        <td><a href="{{ route('tweets.show',$tweet->id)}}" class="btn btn-primary">View</a></td>
                        <td><button id="ajaxView" class="btn btn-primary" onclick="getViaAjax({{$tweet->id}})" >View Ajax</button></td>
                        <td><a href="{{ route('tweets.edit',$tweet->id)}}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('tweets.destroy', $tweet->id)}}" method="post">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ route('tweets.create') }}" class="btn btn-success m-5">Add New Post</a>
            {!! $tweets->links() !!}
        </div>
        <div id="modelBody">
        </div>
        <button hidden id="popup" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        </button>
    </div>
    <script>
        function getViaAjax(tweetId) {
            $.ajax({
                type:"GET",
                url:"tweets/"+tweetId+"/ajax",
                success: function(data) {
                    insertToHomePage(data)
                    $("#popup").click()
                }
            });
        }
        function insertToHomePage(tweet) {
            newtweet=tweet;
            let modelDiv = document.getElementById("modelBody")
            console.log(modelDiv);
            modelDiv.insertAdjacentHTML('beforeend', `
               <div class="container">
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Tweet Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
             <h4>title : ${newtweet.tweet.title}</h4>
             <h4>description:  ${newtweet.tweet.description}</h4>
              <h4>slug:  ${newtweet.tweet.slug}</h4>
             <h4>username:  ${newtweet.tweet.user.name}</h4>
             <h4>useremail: ${newtweet.tweet.user.email}</h4>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </div>

 `)
        }
    </script>
@endsection
