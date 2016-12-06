<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Column;
use App\User;
use Illuminate\Validation\Rule;

class ColumnController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['edit', 'show','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('columns.allcolumns');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('columns.newcolumn');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255|unique:columns',
            'description' => 'required',
            'user' => 'required',
        ]);

        $column = new Column();
        $column->name = $request->name;
        $column->description = $request->description;
        $column->admin_id = $request->User()->id;

        $user = User::find($request->user);
        $user->columns()->save($column);

        return view('info',['title'=>'SUCCESS', 'content'=>'New Column Successfully Added','link'=>'/column','link_text'=>'View All Columns']);


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
        $col = Column::findOrFail($id);
        $articles = $col->articles()->paginate(25);

        return view('post.allarticles',['articles' => $articles,'col'=>$col] );
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
        $col = Column::findOrFail($id);
        return $col;
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
        $this->validate($request, [
            'name' => 'required|max:255',Rule::unique('columns')->ignore($id),
            'description' => 'required',
        ]);

        $col = Column::findOrFail($id);

        $col->name = $request->name;
        $col->description = $request->description;

        $col->save();

        return response()->json(['success'=>true]);
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
        Column::destroy($id);
        return response()->json(['success'=>true]);
    }
}
