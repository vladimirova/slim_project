<?php
namespace Application\Controllers;

use Application\Models\Appointment\AppointmentEntity;
use Application\Models\Appointment\AppointmentRepository;
use Application\Models\AppointmentStatus\AppointmentStatusRepository;
use Application\Models\AppointmentHour\AppointmentHourRepository;
use Application\Models\User\UserEntity;
use Application\Models\User\UserRepository;

class LawyerAppointmentsController extends BaseController
{
    public function listView($request, $response, $args)
    {
        $appointmentRepository = new AppointmentRepository($this->container->db);

        $auth = $this->container->get('auth');
        $appointments = $appointmentRepository->fetchByLawyer($auth->id());

        return $this->container->view->render($response, 'lawyer/appointments.twig', [
            'appointments' => $appointments
        ]);
    }

    public function update($request, $response, $args)
    {
        $appointmentRepository = new AppointmentRepository($this->container->db);
        $appointmentStatusRepository = new AppointmentStatusRepository($this->container->db);
        $router = $this->container->router;

        $appointment =$appointmentRepository->findByPrimaryKey($args['id']);

        if($appointment == false || ($appointment->getLawyerId() != $this->container->auth->id())) {

            return $response->withRedirect($router->pathFor('lawyerAppointments'));
        };

        $attributes = $request->getParsedBody();

        $appointment->setDate($attributes['date']);
        $appointment->setHourId($attributes['hour_id']);

        if($appointmentRepository->checkIfExists($appointment)) {

            return $response->withRedirect($router->pathFor('lawyerAppointments'));
        };


        $modified = $appointmentStatusRepository->findByName($appointmentStatusRepository::NAME_MODIFIED);
        $appointment->setStatusId($modified->getId());

        $appointmentRepository->update($appointment);

        return $response->withRedirect($router->pathFor('lawyerAppointments'));
    }

    public function approve($request, $response, $args)
    {
        $appointmentRepository = new AppointmentRepository($this->container->db);
        $appointmentStatusRepository = new AppointmentStatusRepository($this->container->db);
        $router = $this->container->router;

        $appointment =$appointmentRepository->findByPrimaryKey($args['id']);

        if($appointment == false || ($appointment->getLawyerId() != $this->container->auth->id())) {
            return $response->withRedirect($router->pathFor('lawyerAppointments'));
        };

        $approved = $appointmentStatusRepository->findByName($appointmentStatusRepository::NAME_APPROVED);
        $appointment->setStatusId($approved->getId());

        $appointmentRepository->update($appointment);

        return $response->withRedirect($router->pathFor('lawyerAppointments'));
    }

    public function updateView($request, $response, $args)
    {
        $appointmentRepository = new AppointmentRepository($this->container->db);
        $appointmentStatusRepository = new AppointmentStatusRepository($this->container->db);
        $hourRepository = new AppointmentHourRepository($this->container->db);

        $hours = $hourRepository->all();
        $statuses = $appointmentStatusRepository->all();

        $appointment = $appointmentRepository->findByPrimaryKey($args['id']);

        return $this->container->view->render($response, 'lawyer/update.twig', [
            'appointment' => $appointment,
            'hours' => $hours,
            'statuses' => $statuses,
        ]);
    }
}
