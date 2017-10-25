<?php

namespace MyFramework;

use Appdefault\DefaultController;

abstract class Controller
{
    protected $viewPath;
    protected $template;

    // Initiate the Twig environment to display the views
    public function startTwig($viewPath, $view, $variables, $varname, $title, $stylePath)
    {
        $loader = new \Twig_Loader_Filesystem($viewPath);
        $twig = new \Twig_Environment($loader, [
            'cache' => false // ROOT . '/tmp' in production
        ]);

        // Addtwig extension for text manipulation (not required)
        $twig->addExtension(new \Twig_Extensions_Extension_Text());

        echo $twig->render($view, array(
            'title' => $title,
            $varname => $variables,
            'stylePath' => $stylePath
        ));
    }

    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        $controller = new DefaultController();
        $controller->postDoesntExists();
    }
}