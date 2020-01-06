<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreTweetRequest;
use App\Http\Resources\TweetResouce;
use App\Rules\MoreThreePosts;
use App\Tweet;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function index()
    {
        return view('tweets.index')->with('tweets', Tweet::paginate(2));
    }

    public function create()
    {
        return view('tweets.create');
    }

    public function store(StoreTweetRequest $request)
    {
        $request->merge(['userPosts' => count(Auth::user()->tweets)]);
        $this->validate($request, ['userPosts' => new MoreThreePosts]);
        $tweet= Tweet::create([
             'title' => $request->title,
             'description' =>$request->description,
             'image'=> $request->image->store('images'),
             'user_id' => Auth::user()->getAuthIdentifier(),
        ]);
        $tweet->attachTags(explode(',',$request->tags));
        $tweet->save();
        return redirect()->route('tweets.index');
    }

    public function show($tweet)
    {
        $tweet=Tweet::where('id','=',$tweet)->first();
       return view('tweets.show',['tweet'=>$tweet]);
    }
    public function showAjax($tweet){
        $tweet=Tweet::where('id','=',$tweet)->with('user')->first();
        return response()->json(['tweet'=>$tweet]);

    }
    public function comment($tweet){
        $tweetObj=Tweet::where('id','=',$tweet)->first();
        $comment = new Comment();
        $comment->body=request()->body;
        $comment->commentable_id = $tweet;
        $comment->commentable_type = 'App\Tweet';
        $comment->save();
        return redirect()->route('tweets.show',$tweet);

    }

    public function edit($tweet)
    {
        $tweet = Tweet::where('id','=',$tweet)->first();
        return view('tweets.edit', ['tweet'=>$tweet]);
    }

    public function update($tweet)
    {
        $tweetObj=Tweet::where('id','=',$tweet)->first();
        $tweetObj->slug = null;
        $tweetObj->update(['title' => \request()->title, 'description' => \request()->description]);
        Storage::delete($tweetObj->image);
        $tweetObj->image=\request()->image->store('images');
        $tweetObj->save();
        return redirect()->route('tweets.index');
    }

    public function destroy($tweet)
    {
        Tweet::where('id',$tweet)->delete();
        return redirect()->route('tweets.index');
    }
}
