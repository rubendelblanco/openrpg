<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api,jwt');
    }

    public function sendMessage($message, $status = 200)
    {
        return response()->json(['message' => $message], $status);
    }
}
