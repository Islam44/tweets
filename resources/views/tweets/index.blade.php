@extends('tweets.app')
@section('content')
    <br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered m-5" id="laravel_crud">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created at</th>
                    <td colspan="3">Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($tweets as $tweet)
                    <tr>
                        <td>{{ $tweet->id }}</td>
                        <td>{{ $tweet->title }}</td>
                        <td>{{ $tweet->description }}</td>
                        <td>{{ date('Y-m-d', strtotime($tweet->created_at)) }}</td>
                        <td><a href="{{ route('tweets.show',$tweet->id)}}" class="btn btn-primary">View</a></td>
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
    </div>
@endsection
