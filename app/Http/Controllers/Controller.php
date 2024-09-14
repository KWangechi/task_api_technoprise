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
        if (is_string($errors) && isset($errors)) {
            return response()->json([
                'status' => [
                    $status_code,
                    $message
                ],
                'data' => []
            ], $status_code);
        }
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
