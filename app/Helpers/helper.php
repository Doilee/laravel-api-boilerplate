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