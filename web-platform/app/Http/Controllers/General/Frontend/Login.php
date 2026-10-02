<?php
namespace App\Http\Controllers\General\Frontend;
use Illuminate\Http\Request;

class Login
{
    public function login(Request $request)
    {
        if (auth()->user()) {
            return redirect('/home');
        }
        return view('login');
    }
}
