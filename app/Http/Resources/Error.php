<?php

namespace App\Http\Resources;

class Error
{
    static function error404(string $message = null)
    {
        return response()->json(['message' => $message], 404);
    }
}
