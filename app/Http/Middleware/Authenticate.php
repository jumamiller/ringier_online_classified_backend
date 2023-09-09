<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //if expected json response
        if ($request->expectsJson()) {
            return null;
        } else {
            //throw unauthenticated exception
            throw new AuthenticationException();
        }
    }
}
