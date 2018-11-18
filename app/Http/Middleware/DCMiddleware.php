<?php

namespace App\Http\Middleware;

use Closure;

class DCMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentUser = $request->user();
        $currentActionName = $request->route()->getActionName();
        list($controller, $method) = explode('@', $currentActionName);
        $controller = str_replace(["App\\Http\\Controllers\\", "Controller"], "", $controller);
//        dd("$controller $method");
        $classesMap = [
            'Comment' => 'comment'
        ];
        $currentPermissionsMap = [
            'crud' => ['index', 'destroy']
        ];

        foreach ($currentPermissionsMap as $permission => $methods){
            if (in_array($method, $methods) && isset($classesMap[$controller])){
                $className = $classesMap[$controller];
//                dd("{$permission}-{$className}");
//                "crud-comment"     its my given permission name
                if (! $currentUser->can("{$permission}_{$className}")){
                    abort(403);
                }
                break;
            }
        }
        return $next($request);
    }
}
