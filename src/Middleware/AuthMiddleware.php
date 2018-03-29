<?php

namespace Application\Middleware;

use Slim\Router;
use Application\Custom\Auth;

class AuthMiddleware
{
    protected $router;

    protected $auth;

    protected $except = [
        'login',
        'registration'
    ];

    public function __construct(Router $router, Auth $auth)
    {
        $this->router = $router;
        $this->auth = $auth;
    }

    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route');
        $routeName = $route->getName();

        if (!$this->auth->check()) {
            if (!in_array($routeName, $this->except)) {
                return $response->withRedirect($this->router->pathFor('login'));
            }
        }

        return $next($request, $response);
    }
}
