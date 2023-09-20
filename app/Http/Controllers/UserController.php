<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index($message = null){
        $users = User::orderBy('id','asc')->paginate(3);
        if($message != null){
            $users->message = $message;
        }
        return view('users.index',compact('users'));
    }
    public function create(){
        $user = new User;
        $user->page = 'Create user';
        return view('users.form',compact('user'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:2',
            'password' => 'required',
            'email' => 'required|email'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->save();
        
        $message = array();

        return redirect('/users')->with('message','User has been created.');
    }
    public function edit($id){
        $user = User::findOrFail($id);
        $user->page = 'Edit Form';
        return view('users.form',compact('user'));
    }

    public function destroy($id){
        $user = User::findOrFail($id)->destroy($id);
    }
}