<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PicturePost;
use Auth;

class PicturePostController extends Controller
{

    public function __construct()
    {
        $this->middleware('countview')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check())
            return view('post.picturepost',['posts'=>Post::where('type','Photo')->paginate(10)]);
        else
            return view('guest.picturepost',['posts'=>Post::where('type','Photo')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->page == 'upload'){
            return view('post.uploadphotos');
        }elseif($request->page == 'create')
            return view('post.newphotopost');
        elseif($request->page == 'describe')
            return view('post.describephotos');
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
        if($request->page == 'describe'){
            foreach($request->lead as $key => $value){
                $p = PicturePost::findOrFail($key);
                $p->description = $value;
                $p->save();
            }

            if($request->has('publish')){

                $p = Post::findOrFail($request->post_id);
                $p->isPublished = 1;

                $p->save();

                $p->users()->attach($request->user()->id, ['action' => 'Publish']);
            }


            return view('info',['title'=>'SUCCESS', 'content'=>'Post Created Successfully','link'=>'/photos','link_text'=>'All Picture Post']);
            
            


        }elseif($request->page == 'create'){
            //create new Post goes here;

            $this->validate($request, [
                'title' => 'required',
                'lead' => 'required',
            ]);
            $post = new Post();

            $post->title = $request->title;
            $post->lead = $request->lead;
            $post->type = 'Photo';
            $post->isPublished = 0;

            $post->inSlideShow = 0;

            $post->save();
            
            $post->users()->attach($request->user()->id, ['action' => 'Create']);

            return redirect(url('/photos/create?page=upload&photo='.$post->id));
        }
       
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
        return view('guest.viewpicture',['pos'=>Post::findOrFail($id)]);
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
