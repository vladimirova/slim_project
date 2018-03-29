<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// $app->get('/', Application\Controllers\AuthController::class. ':home')->setName('home');

// auth routes
$app->get('/', Application\Controllers\AuthController::class. ':loginView')->setName('home``');

$app->get('/auth/registration', Application\Controllers\AuthController::class. ':registrationView')->setName('registration');
$app->post('/auth/registration', Application\Controllers\AuthController::class. ':registration')->setName('registration');
$app->get('/auth/login', Application\Controllers\AuthController::class. ':loginView')->setName('login');
$app->get('/auth/logout', Application\Controllers\AuthController::class. ':logout')->setName('logout');
$app->post('/auth/login', Application\Controllers\AuthController::class. ':login')->setName('login');

// for user
$app->get('/appointments/create', Application\Controllers\AppointmentsController::class. ':createView')->setName('createAppointment');
$app->post('/appointments/create', Application\Controllers\AppointmentsController::class. ':create')->setName('createAppointment');
$app->get('/appointments/user', Application\Controllers\AppointmentsController::class. ':listView')->setName('listAppointments');

// for lawyer
$app->get('/appointments/lawyer', Application\Controllers\LawyerAppointmentsController::class. ':listView')->setName('lawyerAppointments');
$app->get('/appointments/lawyer/[{id}]', Application\Controllers\LawyerAppointmentsController::class. ':updateView')->setName('lawyerUpdateAppointment');
$app->get('/appointments/lawyer/approve/[{id}]', Application\Controllers\LawyerAppointmentsController::class. ':approve')->setName('lawyerApproveAppointment');
$app->post('/appointments/lawyer/[{id}]', Application\Controllers\LawyerAppointmentsController::class. ':update')->setName('lawyerUpdateAppointment');
