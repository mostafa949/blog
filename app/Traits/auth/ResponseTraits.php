<?php

namespace App\Traits\auth;

trait ResponseTraits
{
    protected function res($data, string $message = '', int $status = 200)
    {
        $data = [
            'payload' => $data,
            'status' => $status,
            'message' => $message
        ];
        return response()->json($data, $status);
    }
}
