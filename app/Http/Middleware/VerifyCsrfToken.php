<?php


namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    
    
    // public function handle($request, Closure $next, )
    // { 
    //     // return $next($request);
    //     $response = $next($request);
    //     $response->header('Access-Control-Allow-Origin', '*');
    //     $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
    //     $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
    //     $response->header('Access-Control-Allow-Credentials', 'false');
    //     return $response;
    // }
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '*'
    ];

}
