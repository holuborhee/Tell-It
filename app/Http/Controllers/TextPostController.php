<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\TextPost;

class TextPostController extends Controller
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
        $post = TextPost::paginate(25);
        $cat = ['id'=>0,'icon'=>'fa fa-folder','name'=>'All Reports'];
        //return ['posts'=>$post,'cat'=>$cat];
        return view('post.allposts',['posts' => $post,'cat'=>$cat] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->catid == 0){
            $cat = ['id'=>0,'icon'=>'fa fa-folder','name'=>'New Reports'];
            return view('post.newpost',['cat'=>$cat]);
        }
        return view('post.newpost',Category::findOrFail($request->catid));
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
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required'
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->type = 'Text';
        $post->lead = $request->lead;
        if($request->has('publish'))
            $post->isPublished = 1;
        else
            $post->isPublished = 0;

        $post->inSlideShow = 0;

        $post->save();

        $textpost = new TextPost();
        $textpost->body = $request->body;
        
        $textpost->picture = 'none';
        $textpost->category_id = $request->category;

        $post->textpost()->save($textpost);
        
        $post->users()->attach($request->user()->id, ['action' => 'Create']);

        if($request->has('publish'))
                $post->users()->attach($request->user()->id, ['action' => 'Publish']);

        $tagArray = explode(',', $request->news_tag);
        

        foreach($tagArray as $t)
            $post->tags()->attach($t);
                   

        return view('post.uploadpostimage',$post);

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
        return view('guest.viewnews',['article'=>TextPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        if($request->has('act'))
        {
            $text = TextPost::findOrFail($id);
           return view('post.uploadpostimage',Post::findOrFail($text->post_id)); 
        }
        return view('post.editreport',TextPost::findOrFail($id));
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
        if($request->has('act'))
        {
            $t = TextPost::findOrFail($id);
           $article = Post::findOrFail($t->post_id);
           $article->isPublished = 1;
           
           $article->save();

           $article->users()->attach($request->user()->id, ['action' => 'Publish']);
           /*return response()->json($article);*/
           return response()->json(['success'=>true]);
        }

        $this->validate($request, [
            'title' => 'required',
            'lead' => 'required',
            'body' => 'required',
        ]);

        $article = TextPost::findOrFail($id);

        $p = Post::findOrFail($article->post_id);

        $p->title = $request->title;
        $p->lead = $request->lead;
        
        $p->save();
        
        $p->users()->attach($request->user()->id, ['action' => 'Edit']);
        $article->body = $request->body;

        $article->save();

        return view('info',['title'=>'SUCCESS', 'content'=>'Update Successfully','link'=>'/report/'. $id,'link_text'=>'Click To View The Report you just edited']);
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
        $t = TextPost::findOrFail($id);
        $p = Post::findOrFail($t->post_id);
        $p->users()->attach($request->user()->id, ['action' => 'Delete']);
        Post::destroy($t->post_id);
        TextPost::destroy($id);
        return view('info',['title'=>'SUCCESS', 'content'=>'Record Successfully Deleted','link'=>'/user','link_text'=>'Back To Home']);
    }
}
