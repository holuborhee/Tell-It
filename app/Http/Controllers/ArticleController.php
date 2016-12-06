<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Column;
use App\Article;

class ArticleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
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
            
                $column = Column::findOrFail($request->col);
                $post = $column->articles()->latest()->paginate(6);
                if($request->searchword != null AND $request->datefrom != null AND $request->dateto != null)
                    $post = $column->articles()->where('title', 'like', "%{$request->searchword}%")->whereBetween('created_at', ["{$request->datefrom} 00:00:00", "{$request->dateto} 23:59:59"])->latest()->paginate(4);
                elseif($request->datefrom != null AND $request->dateto != null)
                    $post = $column->articles()->whereBetween('created_at', ["{$request->datefrom} 00:00:00", "{$request->dateto} 23:59:59"])->latest()->paginate(4);
                elseif($request->searchword != null)
                    $post = $column->articles()->where('title', 'like', "%{$request->searchword}%")->latest()->paginate(4);   
                 

            


            return response()->json($post);
        }
        $article = Article::latest()->paginate(10);
        return view('guest.allarticles',['posts'=>$article]);
        //return $post;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
       /* if($request->colid == 0){
            $col = ['id'=>0,'name'=>'New Article'];
            return view('post.newarticle',['col'=>$col]);
        }*/
        return view('post.newarticle',Column::findOrFail($request->colid));
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
            'column' => 'required',
        ]);


        $article = new Article();

        $article->title = $request->title;
        $article->lead = $request->lead;
        $article->body = $request->body;
        

        if($request->has('publish'))
            $article->isPublished = 1;
        else
            $article->isPublished = 0;

        $article->inThumbnail = 0;
        $article->picture = 'none';
        Column::find($request->column)->articles()->save($article);

        $tagArray = explode(',', $request->news_tag);
        

        foreach($tagArray as $t)
            $article->tags()->attach($t);

        return view('post.uploadarticleimage',$article);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('guest.viewnews',['article'=>Article::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->has('act'))
           return view('post.uploadarticleimage',Article::findOrFail($id)); 
        return view('post.editarticle',Article::findOrFail($id));
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
           $article = Article::findOrFail($id);
           $article->isPublished = 1;
           $article->save();
           /*return response()->json($article);*/
           return response()->json(['success'=>true]);
        }
        $this->validate($request, [
            'title' => 'required',
            'lead' => 'required',
            'body' => 'required',
        ]);

        $article = Article::findOrFail($id);

        $article->title = $request->title;
        $article->lead = $request->lead;
        $article->body = $request->body;

        $article->save();

        return view('info',['title'=>'SUCCESS', 'content'=>'Update Successfull','link'=>'/article/'. $id,'link_text'=>'Click To View The Article']);
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
        Article::destroy($id);
        return view('info',['title'=>'SUCCESS', 'content'=>'Record Successfully Deleted','link'=>'/user','link_text'=>'Back To Home']);
    }
}
