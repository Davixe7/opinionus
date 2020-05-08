<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.users.index', [ 'users'=>User::paginate(100) ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = User::create([
        'name'  => $request->name,
        'email' => $request->email,
        'password'  => bcrypt($request->password)
      ]);
      
      if( $request->expectsJson() ){
        return response()->json(['data'=>$user]);
      }
      return view('admin.users.index', ['users'=>User::all()] );
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
    public function edit(Request $request, User $user)
    {
      return view('admin.users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $user->update([
        'name'  => $request->name ?: $user->name,
        'email' => $request->email ?: $user->email,
        'password'  => bcrypt($request->password) ?: $user->password
      ]);
      
      if( $request->expectsJson() ){
        return response()->json(['data'=>$user]);
      }
      return view('admin.users.index', ['users'=>User::all()] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
      $user->delete();
      if( $request->expectsJson() ){
        return response()->json(['data'=>$user]);
      }
      return view('admin.users.index', ['users'=>User::all()] );
    }
}
