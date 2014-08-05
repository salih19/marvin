<?php

namespace Marvin\Core\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;


class InstallControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        // Install
        $controllers->get('/', function () use ($app) {
            $messages = $app['install']();

            return $app['twig']->render('admin/install.twig', array(
                'messages' => $messages,
            ));
        });


        return $controllers;
    }
}