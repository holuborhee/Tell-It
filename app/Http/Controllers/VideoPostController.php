<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\VideoPost;
use Auth;

class VideoPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check())
            return view('post.videopost',['posts'=>VideoPost::paginate(10)]);
        else
            return view('guest.videopost',['posts'=>VideoPost::paginate(10)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.newvideopost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'lead' => 'required',
            'url' => 'required|url',

        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->lead = $request->lead;
        $post->type = 'Video';
        if($request->has('publish'))
            $post->isPublished = 1;
        else
            $post->isPublished = 0;

        $post->inSlideShow = 0;

        $post->save();

        $videopost = new VideoPost();
        $videopost->url = $request->url;

        $post->videoPost()->save($videopost);

        $post->users()->attach($request->user()->id, ['action' => 'Create']);

        if($request->has('publish'))
                $post->users()->attach($request->user()->id, ['action' => 'Publish']);
                   

        return view('info',['title'=>'SUCCESS', 'content'=>'Video Post Created Successfully','link'=>'/videos','link_text'=>'Go to all Videos']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
