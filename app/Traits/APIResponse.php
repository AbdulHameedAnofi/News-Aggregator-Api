<?php

namespace App\Traits;

trait APIResponse
{
    //
    public function success(?string $message, $data = null, int $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message'=> $message,
            'data' => $data
        ], $code);
    }
    
    public function error(?string $message, $data = null, int $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message'=> $message,
            'data' => $data
        ], $code);
    }
}
