<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 03/10/2017
 * Time: 14:35
 */

namespace MyFramework\Router;

// require 'route.php';


class Router
{
    private $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = $url;
    }
    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }
    public function post($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    public function getRouting()
    {
        // Checking if $_SERVER['REQUEST_METHOD'] exists in the routes array
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
        {
            // if not, an exception is thrown
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        // check a potential match on each routes array entry
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            // If it does find a match
            if($route->match($this->url)) {
                return $route->call();
            }
        }
        $route->noMatchingRoute();
        // throw new RouterException('No matching route');
    }

}