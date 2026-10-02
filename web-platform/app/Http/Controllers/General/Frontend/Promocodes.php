<?php
namespace App\Http\Controllers\General\Frontend;
use Illuminate\Http\Request;

class Promocodes
{
    public function promocodes(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        return view('promocodes');
    }
}
