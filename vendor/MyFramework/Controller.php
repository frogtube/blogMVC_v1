<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 04/10/2017
 * Time: 14:56
 */
namespace MyFramework;

use Appdefault\DefaultController;

abstract class Controller
{
    protected $viewPath;
    protected $template;

    public function startTwig($viewPath, $view, $variables, $varname, $title, $stylePath)
    {
        $loader = new \Twig_Loader_Filesystem($viewPath);
        $twig = new \Twig_Environment($loader, [
            'cache' => false // ROOT . '/tmp' in production
        ]);

        // Adding twig extension for text manipulation
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