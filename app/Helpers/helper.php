<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('me'))
{
    /**
     * Returns the logged in user.
     *
     * @return \App\User|null
     */
    function me() : ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
}

if (!function_exists('frontend'))
{
    /**
     * Returns the path to the frontend.
     *
     * @param null $path
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function frontend($path = null)
    {
        return url(config('app.frontend') . '/' . $path);
    }
}