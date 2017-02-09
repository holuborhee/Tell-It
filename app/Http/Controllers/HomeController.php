<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Article;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['adverts','customize']);
    }

    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

   /* public function test()
    {
        //return view('test');
        $t = Tag::where('id', '>', 50000)->get();
        return response()->json($t);
    }*/

    public function changePassword()
    {
        return view('changePassword');
    }

    public function adverts(Request $request)
    {
        if($request->has('page'))
            return view('uploadadvert',['id'=>$request->page]);
        return view('advert');
    }


/**
     * User changes own Password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $user = $request->user();

        $user->password = bcrypt($request['password']);
        

        if($user->isActivated === false)
            $user->isActivated = 1;

        $user->save();
        return view('info',['title'=>'SUCCESS', 'content'=>'You have successfully Changed Password','link'=>'/','link_text'=>'Go to Dashboard']);
    }

    public function checkpassword(Request $request)
    {
        return response()->json(['success'=>Hash::check($request->password,$request->user()->password)]);
        
        if(bcrypt($request['password']) == $request->user()->password)
        {
            return response()->json(['success'=>true]);
        }
        else
        {
            return response()->json(['success'=>false]);
        }
    }

    public function customize()
    {
        
        

        return view('random.customize',['posts'=>Post::where('inslideshow',1)->with('textpost')->latest()->get(),'articles'=>Article::where('inthumbnail',1)->latest()->get()]);
    }
}
