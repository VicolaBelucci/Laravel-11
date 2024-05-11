<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskFilterCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routesToShow = ['task.index'];

        $currentRouteName = $request->route()->getName();
        // dd($currentRouteName, $request->route());

        if (isset($currentRouteName) && in_array($currentRouteName, $routesToShow)) {

            view()->share('categoryFilter', true);
        }

        return $next($request);
    }
}
