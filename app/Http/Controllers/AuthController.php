<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $email = $request->email;
                $password = $request->password;

                if(Auth::attempt(['email' => $email, 'password' => $password])) {
                    return redirect()->route('index');
                } else {
                    return redirect()->route('auth.login');
                }
                break;

            case 'GET':
                return view('auth.index');
                break;
        }

    }
}
