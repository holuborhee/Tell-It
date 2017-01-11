<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PicturePost;
use App\Article;
use Illuminate\Support\Facades\Storage;

class PhotoUploadController extends Controller
{
    //

    public function photoNews(Request $request)
    {

    	$this->validate($request, [
                'file' => 'image',
        ]);
    	if ($request->file('file')->isValid()) {
    		//
    		//$photo = $request->file('file');
    		//$folder = Storage::makeDirectory('images/uploads/post/'.$request->post_id);
    		$path = $request->file('file')->store('reports/'.$request->post_id,'local');
    		$photo = new PicturePost();
    		$photo->picture = $path;

    		Post::findOrFail($request->post_id)->photos()->save($photo);
    		return response()->json('', 200);
		}
    	else
    	return response()->json('', 500);
    }

    public function articleDisplayPicture(Request $request)
    {

        $this->validate($request, [
                'file' => 'image',
        ]);
        if ($request->file('file')->isValid()) {
            //
            //$photo = $request->file('file');
            //$folder = Storage::makeDirectory('images/uploads/post/'.$request->post_id);
            Storage::deleteDirectory('articles/'.$request->post_id);
            $path = $request->file('file')->store('articles/'.$request->post_id,'local');
            $article = Article::findOrFail($request->post_id);
            $article->picture = $path;

            $article->save();
            return response()->json('', 200);
        }
        else
        return response()->json('', 500);
    }


    public function postDisplayPicture(Request $request)
    {

        $this->validate($request, [
                'file' => 'image',
        ]);
        if ($request->file('file')->isValid()) {
            //
            //$photo = $request->file('file');
            //$folder = Storage::makeDirectory('images/uploads/post/'.$request->post_id);
            Storage::deleteDirectory('reports/'.$request->post_id);
            $path = $request->file('file')->store('reports/'.$request->post_id,'local');
            $post = Post::findOrFail($request->post_id)->textpost;
            $post->picture = $path;

            $post->save();
            return response()->json('', 200);
        }
        else
        return response()->json('', 500);
    }

    public function removephotoNews(Request $request)
    {

    	
    	/*if ($request->file('file')->isValid()) {
    		//
    		//$photo = $request->file('file');
    		//$folder = Storage::makeDirectory('images/uploads/post/'.$request->post_id);
    		$path = $request->file('file')->store('images/uploads/post/'.$request->post_id);
    		$photo = new PicturePost();
    		$photo->picture = $path;

    		Post::findOrFail($request->post_id)->photos()->save($photo);
    		return response()->json('', 200);
		}
    	else*/
    	return response()->json('', 200);
    }
}
