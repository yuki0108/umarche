<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $user_root = 'user.login';
    protected $owner_root = 'owner.login';
    protected $admin_root = 'admin.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::id('owner.*')){
                return route($this->owner_root);
            } elseif(Route::id('admin.*')){
                return route($this->admin_root);
            } else {
                return route($this->user_root);
            }
        }
    }
}