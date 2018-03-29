<?php
namespace Application\Controllers;

use Application\Models\Appointment\AppointmentEntity;
use Application\Models\Appointment\AppointmentRepository;
use Application\Models\AppointmentHour\AppointmentHourRepository;
use Application\Models\AppointmentStatus\AppointmentStatusRepository;
use Application\Models\User\UserRepository;

class AppointmentsController extends BaseController
{
    public function listView($request, $response, $args)
    {
        $appointmentRepository = new AppointmentRepository($this->container->db);

        $appointments = $appointmentRepository->fetchByUser($_SESSION['auth_user']->getId());

        return $this->container->view->render($response, 'appointments/list.twig', [
            'appointments' => $appointments
        ]);
    }

    public function createView($request, $response, $args)
    {
        $hourRepository = new AppointmentHourRepository($this->container->db);
        $userRepository = new UserRepository($this->container->db);

        $hours = $hourRepository->all();
        $lawyers = $userRepository->lawyers();

        return $this->container->view->render($response, 'appointments/create.twig', [
            'hours' => $hours,
            'lawyers' => $lawyers,
        ]);
    }

    public function create($request, $response, $args)
    {
        $appointmentRepository = new AppointmentRepository($this->container->db);
        $appointmentStatusRepository = new AppointmentStatusRepository($this->container->db);

        $status = $appointmentStatusRepository->findByName($appointmentStatusRepository::NAME_AWAITING);
        $router = $this->container->router;
        $attributes = $request->getParsedBody();

        $attributes['user_id'] = $this->container->auth->id();
        $attributes['status_id'] = $status->getId();

        $appointment = new AppointmentEntity($attributes);

        if($appointmentRepository->checkIfExists($appointment)) {

            return $response->withRedirect($router->pathFor('lawyerAppointments'));
        };

        $appointmentRepository->insert($appointment);

        return $response->withRedirect($router->pathFor('listAppointments'));
    }
}
