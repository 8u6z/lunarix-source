<?php
namespace App\Http\Controllers\General\Frontend;
use Illuminate\Http\Request;

class MyMoney
{
    public function mymoney(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        return view('my.money');
    }
}
