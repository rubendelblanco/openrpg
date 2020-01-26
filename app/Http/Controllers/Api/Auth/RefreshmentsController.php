<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefreshmentsController extends Controller
{
    public function store(Request $request) {
        $new_token = auth('jwt')->refresh();
        return response()->json(['token' => $new_token]);
    }
}
