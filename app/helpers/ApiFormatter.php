<?php

namespace App\Helpers;

class ApiFormatter{
    public static function createApi($message, $data = null, $status = true, $code = 200)
    {
        $result = [
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ];

        return response()->json($result, $code);
    }
}