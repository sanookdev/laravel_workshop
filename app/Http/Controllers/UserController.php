<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::orderBy('id','asc')->whereBetween('id',[10,22])->paginate(3);
        return view('users.index',compact('users'));
    }
    
    public function create(){
        $user = new User;
        $user->page = 'Create user';
        return view('users.form',compact('user'));
    }

    public function store(StoreUserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->save();
        $response = array(
            'message' => 'User has been created.',
            'status' => true,
            'class' => 'alert alert-success mt-3'
        );
        return redirect('/users')->with($response);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $user->page = 'Edit Form';
        return view('users.form',compact('user'));
    }

    public function update(StoreUserRequest $request,$id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update(); 
        $response = array(
            'message' => 'User has been updated.',
            'status' => true,
            'class' => 'alert alert-success mt-3'
        );
        return redirect('/users')->with($response);
    }

    public function destroy($id){
        $user = User::findOrFail($id)->destroy($id);
        $response = array(
            'message' => 'User has been deleted.',
            'status' => true,
            'class' => 'alert alert-danger mt-3'
        );
        return response()->json($response);
    }
}