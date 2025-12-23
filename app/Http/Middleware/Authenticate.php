<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
<<<<<<< HEAD
        return $request->expectsJson() ? null : route('login.view');
=======
        // Return null for JSON requests to return a 401 JSON response
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        return route('login.view');
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
    }
}
