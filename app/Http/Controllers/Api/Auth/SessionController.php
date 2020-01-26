<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function show(Request $request) {
        return response()->json(['user' => auth('jwt')->user()]);
    }

    public function destroy(Request $request) {
        auth('jwt')->logout();
        return response()->noContent();
    }
}
