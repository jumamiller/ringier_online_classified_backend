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

    /**
     * @param string $number
     * @param $phone_code
     * @return string
     */
    public function getMsisdn(string $number,$phone_code): string
    {
        $number = trim($number);
        $number = str_replace(' ', '', $number);
        $number = str_replace('+', '', $number);

        if (str_starts_with($number, $phone_code)){
            if (str_starts_with($number, $phone_code.'0'))
                $number = substr_replace($number, '', 3, 1);
            return $number;
        }
        $number = $number[0] === '0' ? ltrim($number, 0) : $number;
        return $phone_code.$number;
    }
}
