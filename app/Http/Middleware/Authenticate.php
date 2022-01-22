<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Exception;
use Laravel\Passport\Passport;

class Authenticate extends Middleware
{
    protected $guards = [];
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        try {

            $uri = $request->path();
            $this->authenticate($request, $guards);
            $user = $request->user();

            if ($uri == '' && !$request->user()->tokenCan('place-orders_1')) { // api/user is api route &  $request->user()->tokenCan('place-orders_1') is permission checker code.
                return \Illuminate\Support\Facades\Response::make('user has not permission', 403);
            }
            return parent::handle($request, $next, ...$guards);
        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Response::make("Authorization Token not found", 401);
        }
    }
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            //return route('login');
            return '';
        }
    }
}
