<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class GuestController extends Controller
{
    //
    public function index()
    {

    	$post = Post::latest()->paginate(8);
        return view('guest.index', ['posts' => $post]);
    }
}
