<?php
namespace Application\Controllers;

use Application\Models\Appointment\AppointmentEntity;
use Application\Models\Appointment\AppointmentRepository;
use Application\Models\User\UserEntity;
use Application\Models\User\UserRepository;

class AuthController extends BaseController
{

    public function registrationView($request, $response, $args)
    {
        return $this->container->view->render($response, 'auth/registration.twig');
    }

    public function loginView($request, $response, $args)
    {
        return $this->container->view->render($response, 'auth/login.twig');
    }

    public function logout($request, $response, $args)
    {
        $router = $this->container->router;

        $this->container->session->destroy();

        return $response->withRedirect($router->pathFor('login'));
    }

    public function login($request, $response, $args)
    {
        $repository = new UserRepository($this->container->db);
        $router = $this->container->router;
        $user = $repository->login($request->getParsedBodyParam('email'), md5($request->getParsedBodyParam('password')));

        if ($user === false) {
           return $response->withRedirect($router->pathFor('login'));
        }

        $session = $this->container->session;
        $auth = $this->container->auth;

        $auth->authenticate($user);

        if ( $user->getRoleId() != 2 ) {
            return $response->withRedirect($router->pathFor('createAppointment'));
        }
        return $response->withRedirect($router->pathFor('lawyerAppointments'));
    }

    public function registration($request, $response, $args)
    {
        $attributes = $request->getParsedBody();
        $router = $this->container->router;
        $attributes['password'] = md5($attributes['password']);
        $attributes['role_id'] = 1;

        $user = new UserEntity($attributes);
        $repository = new UserRepository($this->container->db);

        $repository->insert($user);

        return $response->withRedirect($router->pathFor('createAppointment'));
    }
}
