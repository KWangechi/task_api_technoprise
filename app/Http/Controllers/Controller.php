<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Define all the global responses e.g success and error responses
 */
class Controller extends BaseController
{
    protected function setErrorMessage($message, $errors = null, $status_code = 422)
    {
        return response()->json([
            'message' => $message,
            'status' => [
                'code' => $status_code,
                'errors' => $errors
            ],
        ], $status_code);
    }

    protected function setSuccessMessage($message, $data = null, $status_code = 200)
    {
        return response()->json([
            'status' => [
                'code' => $status_code,
                'message' => $message
            ],
            'data' => $data
        ], $status_code);
    }
}
