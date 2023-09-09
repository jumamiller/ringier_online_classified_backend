<?php

namespace App\Traits;

trait ApiResponder
{
    /**
     * @description: This function is used to send success response
     * @param $data
     * @param $message
     * @param $code
     * @param $meta
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data=null,$message=null, $code=200,$meta=null,$errors=null)
    {
        return response()->json([
            'success'   =>true,
            'message'   =>$message,
            'data'      =>$data,
            'meta'      =>$meta,
            'errors'    =>$errors
        ], $code);
    }

    /**
     * @description: This function is used to send error response
     * @param bool $success
     * @param string|null $message
     * @param int $code
     * @param $data
     * @param $meta
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, $code = 500,$meta=null,$errors=null)
    {
        return response()->json([
            'success'   =>false,
            'message'   =>$message,
            'meta'      =>$meta,
            'errors'    =>$errors
        ], $code);
    }
}
