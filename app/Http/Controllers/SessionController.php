<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('../posts')->with('success' , 'GoodBye!');
    }

    public function loginView(){
        return view('login.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'username' => ['required' , 'exists:users,username'],
            'password' => ['required'],
        ]);

        if(auth()->attempt($data)){
            return redirect('/posts')->with('success' , 'You are logged in successfully');
        }
        return back()->withErrors([
            'username' => 'Your username credential is wrong try again' ,
            'password' => 'Your provided password is wrong please try again'
            ]);
    }
}
