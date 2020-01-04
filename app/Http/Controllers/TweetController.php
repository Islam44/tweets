<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        return view('tweets.index')->with('tweets', Tweet::paginate(5));
    }

    public function create()
    {
        return view('tweets.create');
    }

    public function store(StoreTweetRequest $request)
    {
        Tweet::create([
            'title' => $request->title,
            'description' =>$request->description
        ]);
        return redirect()->route('tweets.index');
    }

    public function show($tweet)
    {
        $tweet=Tweet::where('id','=',$tweet)->first();
       return view('tweets.show',['tweet'=>$tweet]);
    }

    public function edit($tweet)
    {
        $tweet = Tweet::where('id','=',$tweet)->first();
        return view('tweets.edit', ['tweet'=>$tweet]);
    }

    public function update($tweet)
    {
        Tweet::where('id','=',$tweet)->update(['title' => request()->title, 'description' => request()->description]);
        return redirect()->route('tweets.index');
    }

    public function destroy($tweet)
    {
        Tweet::where('id',$tweet)->delete();
        return redirect()->route('tweets.index');
    }
}
