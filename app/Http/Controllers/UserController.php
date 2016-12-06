<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
		
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}
		return view('users.allusers');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}
		
			   return view('users.newuser');
	   
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}

				$this->validate($request, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'phone' => 'required|max:20|unique:users',
			'gender' => 'required',
			'role' => 'required|exists:roles,id',
			'password' => 'required|min:6|confirmed',
		]);

		User::create([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => bcrypt($request['password']),
			'phone' => $request['phone'],
			'gender' => $request['gender'],
			'role_id' => $request['role'],
			'isActivated' => 0,
		]);

		return view('info',['title'=>'SUCCESS', 'content'=>'Record Successfully Added','link'=>'/user','link_text'=>'View All users']);

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
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}
		return view('users.displayuser',User::findOrFail($id));
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
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}
		return view('users.edituser',User::findOrFail($id));
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
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}
		$this->validate($request, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255',Rule::unique('users')->ignore($id),
			'phone' => 'required|max:20',Rule::unique('users')->ignore($id),
			'password' => 'min:6|confirmed',
		]);
		$user = User::findOrFail($id);
		if($request->has('password'))
			$user->password =  bcrypt($request->password);

		$user->name = $request->name;
		$user->email = $request->email;
		$user->phone = $request->phone;

		$user->save();

		return view('info',['title'=>'SUCCESS', 'content'=>'Record Successfully Updated','link'=>'/user','link_text'=>'View All users']);
		/*$this->save([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => bcrypt($data['password']),
			'phone' => $data['phone'],
			'gender' => $data['gender'],
			'role_id' => $data['role'],
			'isActivated' => 0,
		]);*/
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
		if (!Gate::allows('crud-user')) {
				return redirect('/home');
		}
		User::destroy($id);
		return view('info',['title'=>'SUCCESS', 'content'=>'Record Successfully Deleted','link'=>'/user','link_text'=>'View All users']);
	}
}
