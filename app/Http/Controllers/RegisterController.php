<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required','max:100' , 'min:2'],
            'username' => ['required','max:100' , 'min:4',Rule::unique('users' , 'username')],
            'email' => ['required','max:100', Rule::unique('users','email')],
            'password' => ['required','max:100' , 'min:8']
        ]);
        Author::create([
            'name' => $data['name'],
            'username' => $data['username']
        ]);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/posts')->with('success' , 'Your Account has been successfully created.');

    }


}
