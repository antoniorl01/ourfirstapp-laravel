<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register_user(Request $request) {
        $body = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // add user to db
        return 'uwu';
    }

}
