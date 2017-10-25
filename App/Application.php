<?php

namespace App;

use MyFramework\Router\Router;
use Post\PostController;
use Appdefault\DefaultController;

class Application
{
    protected $name;

    public function __construct()
    {
        $this->name = 'Blog';
    }

    // Call a controller and a specific function upon url
    public function getController()
    {
        // Router Initialization
        $router = new Router($_GET['url']);

        // Homepage
        $router->get('/', function() {
            $controller = new DefaultController;
            $controller->home(null);
        });

        // Contact form sent
        $router->post('/', function() {
            $controller = new DefaultController;
            $controller->contact(null);
        });

        // Create a new blog post with postForm
        $router->get('/post/new', function() {
            $controller = new PostController;
            $controller->create(null);
        });

        // Saving a new blog post to database
        $router->post('/post/new', function() {
            $controller = new PostController;
            $controller->add();
        });

        // Display the full list of blog posts
        $router->get('/posts', function() {
            $controller = new PostController;
            $controller->index();
        });

        // Display a selected blog post
        $router->get('/post/:slug', function() {
            $controller = new PostController;
            $controller->show();
        });

        // Modify a blog post with postForm
        $router->get('/post/edit/:slug', function() {
            $controller = new PostController;
            $controller->update(null);
        });

        // Save modifications of a blog post to database
        $router->post('/post/edit/:slug', function() {
            $controller = new PostController;
            $controller->save();
        });

        // Delete a blog post from database
        $router->post('/post/:slug', function() {
            $controller = new PostController;
            $controller->delete();
        });

        $router->getRouting();
    }

    public function run() { $this->getController(); }
}