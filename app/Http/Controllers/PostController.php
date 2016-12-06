<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->has('act') AND $request->act == 'inslide')
        {
            $post = Post::where('inslideshow',1)->latest()->get();
            return response()->json($post);
        }
        elseif ($request->has('act') AND $request->act == 'search') {
            if($request->category == 'all'){

                $post = Post::latest()->paginate(6);
                if($request->searchword != null AND $request->datefrom != null AND $request->dateto != null)
                    $post = Post::where('title', 'like', "%{$request->searchword}%")->whereBetween('created_at', ["{$request->datefrom} 00:00:00", "{$request->dateto} 23:59:59"])->latest()->paginate(4);
                elseif($request->datefrom != null AND $request->dateto != null)
                    $post = Post::whereBetween('created_at', ["{$request->datefrom} 00:00:00", "{$request->dateto} 23:59:59"])->latest()->paginate(4);
                elseif($request->searchword != null)
                    $post = Post::where('title', 'like', "%{$request->searchword}%")->latest()->paginate(4);   
                 

            }


            return response()->json($post);
        }
        $post = Post::where('inSlideShow',0)->latest()->paginate(2);
        return response()->json($post);
        //return $post;
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
    public function store(Request $request)
    {
        //
        
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
        if($request->has('act') AND $request->act == 'remove')
        {
            $post = Post::findOrFail($id);
            $post->inSlideShow = 0;
            return response()->json(['success'=>$post->save()]);
        }
        $post = Post::findOrFail($id);
        $post->inSlideShow = 1;
        return response()->json(['success'=>$post->save()]);
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
