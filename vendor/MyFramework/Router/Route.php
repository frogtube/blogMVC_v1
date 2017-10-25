<?php

namespace MyFramework\Router;


use Appdefault\DefaultController;

class Route
{
    private $path;
    private $callable;
    private $matches;

    public function __construct($path, $callable)
    {
        // '/' removed from $path
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    // Check matches between url and path
    public function match($url)
    {
        // Initial and final '/' are removed from url
        $url = trim($url, '/');
        // Replace :slug parameter by a regular expression
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        // Check match between regex and url ('i' flag for case insensitive). Matches saved into $matches array
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches))
        {
            // If no matching
            return false;
        }
        // Remove the first entry of the array corresponding to the full url
        array_shift($matches);
        // Save the matches
        $this->matches = $matches;
        // Inform Router of the matching
        return true;
    }

    // Call the callable method of the matching url
    public function call()
    {
        return call_user_func_array($this->callable, $this->matches);
    }

    public function noMatchingRoute()
    {
        $controller = new DefaultController();
        $controller->pageDoesntExists();
    }
}