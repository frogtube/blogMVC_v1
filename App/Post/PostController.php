<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 05/10/2017
 * Time: 06:36
 */

namespace Post;

use Entity\Post;
use Model\PostManager;
use MyFramework\Controller;

class PostController extends Controller
{
    protected $viewPath = ROOT . '/App/Post/views';

    public function __construct()
    {
        $this->viewPath;
        $this->template = 'layout';
    }

    public function index()
    {
        $db = new PostManager();
        $posts = $db->getList();
        $this->startTwig($this->viewPath, 'index.twig', $posts, 'posts','Ugo Pradère | Blog', null);
    }

    public function show()
    {
        // Getting slug from url
        $slug = str_replace('post/', '', $_GET['url']);
        $db = new PostManager();
        $post = $db->getUnique($slug);
        if(!$post == null)
        {
            $this->startTwig($this->viewPath,'show.twig', $post, 'post', 'Ugo Pradère | ' . $slug, '../');
        }
        else
        {
            // If null is returned
            $this->notFound();
        }
    }

    public function update()
    {
        // Getting slug from url
        $slug = str_replace('post/edit/', '', $_GET['url']);
        $db = new PostManager();
        $post = $db->getUnique($slug);
        if(!$post == null)
        {
            $this->startTwig($this->viewPath,'modify.twig', $post, 'post', 'Ugo Pradère | ' . $slug, '../../');
        }
        else
        {// If null is returned
            $this->notFound();
        }
    }

    public function create()
    {
        $this->startTwig($this->viewPath,'create.twig', null, null,'Ugo Pradère | New article', '../');
    }

    public function save()
    {
        $_POST['slug'] = str_replace(' ', '-', $_POST['title']);
        $post = new Post($_POST);
        $db = new PostManager();
        $db->executeSave($post);
        header("Location: ../../post/" . $post->slug());
    }

    public function add()
    {
        $_POST['slug'] = str_replace(' ', '-', $_POST['title']);
        $post = new Post($_POST);
        $db = new PostManager();
        $db->executeAdd($post);
        header("Location: ../post/" . $post->slug());
    }

    public function delete()
    {
        $post = new Post($_POST);
        $db = new PostManager();
        $db->executeDelete($post);
        header("Location: ../posts");
    }
}