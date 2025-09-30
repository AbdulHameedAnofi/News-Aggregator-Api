<?php

namespace App\Traits;

trait APIResponse
{
    //
    public function success(?string $message, $data = null, int $code = 200, array $headers = [])
    {
        return response()->json([
            'status' => 'success',
            'message'=> $message,
            'data' => $data,
        ], $code, $headers);
    }
    
    public function error(?string $message, $data = null, int $code = 400, array $headers = [])
    {
        return response()->json([
            'status' => 'error',
            'message'=> $message,
            'data' => $data

        ], $code, $headers);
    }
}
