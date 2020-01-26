<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    public function store(Request $request) {
        $credentials = $request->only('email', 'password');
        $token = auth('jwt')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        } else {
            return response()->json(['token' => $token]);
        }
    }
}
