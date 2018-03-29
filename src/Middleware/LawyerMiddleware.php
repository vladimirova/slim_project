<?php

namespace Application\Middleware;

use Slim\Router;
use Application\Custom\Auth;

class LawyerMiddleware
{
    protected $router;

    protected $auth;

    protected $routes = [
        'lawyerAppointments',
        'lawyerUpdateAppointmentView',
        'lawyerApproveAppointment',
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

        if (!$this->auth->isLawyer()) {
            if (in_array($routeName, $this->routes)) {
                return $response->withRedirect($this->router->pathFor('listAppointments'));
            }
        }

        return $next($request, $response);
    }
}
