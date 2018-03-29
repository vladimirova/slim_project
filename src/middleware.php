<?php
// Application middleware
$app->add(new \Application\Middleware\AuthMiddleware($app->getContainer()->get('router'), $app->getContainer()->get('auth')));

$app->add(new \Application\Middleware\LawyerMiddleware($app->getContainer()->get('router'), $app->getContainer()->get('auth')));
