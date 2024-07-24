<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    //
    
    public function showloginform()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            if ($user->role == 'admin') {
                return redirect('user');
            }
            else{
                return response()->json('you are not an admin');
            }
        }
        return redirect('showloginform');
    }

    public function logout()
    {
        Session::flush();

        return redirect('showloginform');
    }

    public function guard()
    {
        return Auth::guard('web');
    }
}
