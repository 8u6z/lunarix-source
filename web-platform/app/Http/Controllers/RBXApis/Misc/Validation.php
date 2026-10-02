<?php
namespace App\Http\Controllers\RBXApis\Misc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\Filter;

class Validation extends Controller
{
    public function checkUsernameAvailability(Request $request)
    {
        $username = $request->query('username');
        if ($username && strcasecmp($username, 'TheJongu') === 0) {
            return response()->json(['data' => 0]);
        }
        if (!$username || trim($username) === '') {
            return response()->json(['data' => 2]);
        }
        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            return response()->json(['data' => 2]);
        }
        if (Filter::isInappropriate($username)) {
            return response()->json(['data' => 2]);
        }
        if (User::whereRaw('LOWER(username) = ?', [strtolower($username)])->exists()) {
            return response()->json(['data' => 1]);
        }
        return response()->json(['data' => 0]);
    }

    public function checkUserifexists(Request $request)
    {
        $username = $request->query('username');
        if (User::whereRaw('LOWER(username) = ?', [strtolower($username)])->exists()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}