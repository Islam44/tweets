<?php

namespace App\Http\Controllers\api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweetRequest;
use App\Http\Resources\TweetResouce;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TweetResouce::collection(Tweet::with('user')->with('comments')->with('tags')->paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTweetRequest $request)
    {
        Tweet::create([
            'title' => $request->title,
            'description' =>$request->description,
            'user_id' => Auth::id(),
            'image' => '1'
        ]);

        return TweetResouce::collection(Tweet::paginate(3));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tweet)
    {
        $tweetObj=Tweet::where('id','=',$tweet)->first();
        return new TweetResouce($tweetObj);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($tweet)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
