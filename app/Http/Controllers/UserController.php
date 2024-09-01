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

        $user = User::create($body);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account!');
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
            return redirect('/')->with('success', 'You have successfully logged in.');
        }

        return redirect('/')->with('failure', 'Invalid login.');
    }

    public function logout() 
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.');
    }
}
