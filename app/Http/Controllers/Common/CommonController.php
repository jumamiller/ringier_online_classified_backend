<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CommonController extends Controller
{
    use ApiResponder;
    /**
     * @description This function is used to perform common operations
     * @param $callback
     * @param string|null $message
     * @param array|null $data
     * @param int $status_code
     * @return mixed
     */
    public function commonOperation($callback, string $message = null, array $data = null, int $status_code = 200): mixed
    {
        // Wrap the operation in a transaction
        return DB::transaction(function () use ($callback,$message,$data,$status_code) {
            try {
                // Execute the provided callback function
                $result = $callback();
                // Return the result or perform other actions
                return $this->success($result, $message ?? __('common.created') , $status_code, $data,[]);
            } catch (Exception $e) {
                $trace = request()->has('trace') ? $e->getTrace() : [];
                return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, $status_code, $trace);
            }
        });
    }
}
