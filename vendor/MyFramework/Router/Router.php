<?php

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

    // Save a new route using the method GET
    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    // Save a new route using the method POST
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
    }

}