<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function homepage() 
    {
        if (auth()->check()) {
            return view('homepage-feed');
        }

        return view('homepage');
    }

    public function register(Request $request)
    {
        $body = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $body['password'] = bcrypt($body['password']);

        User::create($body);
        return 'uwu';
    }

    public function login(Request $request) 
    {
        $body = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);
    

        if (auth()->attempt(['username'=>$body['loginusername'], 'password'=>$body['loginpassword']])) 
        {
            $request->session()->regenerate();
            return 'Successful';
        }

        return 'not successful';
    }
}
