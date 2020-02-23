<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    protected $messageKey = 'message';
    protected $errorKey = 'error';

    public function __construct()
    {
        $this->middleware('auth:api,jwt');
    }

    public function sendMessage($message, $status = 200, $headers = [])
    {
        return response()->json([$this->messageKey => $message], $status, $headers);
    }

    public function sendError($message, $status = 400, $headers)
    {
        return response()->json([$this->errorKey => $message], $status, $headers);
    }

    public function sendNotFound($message, $headers = [])
    {
        return $this->sendError($message, 404, $headers);
    }

    public function sendValidationError($message, $headers = [])
    {
        return $this->sendError($message, 422, $headers);
    }

    public function sendInternalError($message, $headers = [])
    {
        return $this->sendError($message, 500, $headers);
    }

    public function sendNoContent($message, $headers = [])
    {
        return $this->sendMessage($message, 204, $headers);
    }
}
