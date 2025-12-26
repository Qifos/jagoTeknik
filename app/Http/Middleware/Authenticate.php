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
<<<<<<< HEAD
        return $request->expectsJson() ? null : route('login.view');
=======
=======
>>>>>>> 04178d1b4cda36a2a838469edd267471fd3d5375
        // Return null for JSON requests to return a 401 JSON response
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        return route('login.view');
<<<<<<< HEAD
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
=======
>>>>>>> 04178d1b4cda36a2a838469edd267471fd3d5375
    }
}
