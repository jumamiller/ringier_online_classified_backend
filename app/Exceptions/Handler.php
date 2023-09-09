<?php

namespace App\Exceptions;

use App\Traits\ApiResponder;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Laravel\Passport\Exceptions\AuthenticationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponder;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @description render auth exception
     * @param $request
     * @param Exception|Throwable $e
     * @return JsonResponse|RedirectResponse|Response|ResponseAlias
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e): Response|JsonResponse|ResponseAlias|RedirectResponse
    {
        if ($e instanceof AuthenticationException) {
            return $this->error($e->getMessage(),  ResponseAlias::HTTP_UNAUTHORIZED, $e->getTrace());
        }
        return parent::render($request, $e);
    }
}
