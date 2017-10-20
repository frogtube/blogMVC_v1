<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 03/10/2017
 * Time: 14:17
 */

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

    public function getController()
    {
        // Router Initialization
        $router = new Router($_GET['url']);

        // Homepage
        $router->get('/', function() {
            $controller = new DefaultController;
            $controller->home();
        });

        // Contact form sent
        $router->post('/', function() {
            $controller = new DefaultController;
            $controller->contact();
        });

        // Create a new article with a form
        $router->get('/post/new', function() {
            $controller = new PostController;
            $controller->create();
        });

        // Saving a new article to database
        $router->post('/post/new', function() {
            $controller = new PostController;
            $controller->add();
            header("Location: ../post/" . $post->slug());
        });

        // Display the full list of articles
        $router->get('/posts', function() {
            $controller = new PostController;
            $controller->index();
        });

        // Display a selected article
        $router->get('/post/:slug', function() {
            $controller = new PostController;
            $controller->show();
        });

        // Modifying an article with a form
        $router->get('/post/edit/:slug', function() {
            $controller = new PostController;
            $controller->update();
        });

        // Saving modifications of an article to database
        $router->post('/post/edit/:slug', function() {
            $controller = new PostController;
            $controller->save();
        });

        // Deleting an article from database
        $router->post('/post/:slug', function() {
            $controller = new PostController;
            $controller->delete();
        });


        $router->run();
    }

    public function run() { $this->getController(); }

    public function name() { return $this->name; }
}