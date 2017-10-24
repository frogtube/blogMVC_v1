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

    public function match($url)
    {
        // initial and final / removed from url
        $url = trim($url, '/');
        // replacing :slug parameter by regular expression
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        // Check match between regex and url ('i' flag for case insensitive). Matches saved into $matches array
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches))
        {
            // If no matching
            return false;
        }
        // removes the first entry of the array corresponding to the full url
        array_shift($matches);
        // saving the matches
        $this->matches = $matches;
        // Inform Router of the matching
        return true;
    }

    public function call()
    {
        // Call the callable method of matching url
        return call_user_func_array($this->callable, $this->matches);
    }

    public function noMatchingRoute()
    {
        $controller = new DefaultController();
        $controller->pageDoesntExists();
    }
}