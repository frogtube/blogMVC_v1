<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 13/10/2017
 * Time: 11:11
 */

namespace Appdefault;


use MyFramework\Controller;
use Services\Services;

class DefaultController extends Controller
{
    protected $viewPath = ROOT . '/App/AppDefault/views';

    public function home()
    {
        $this->startTwig($this->viewPath, 'home.twig', null, null,'Ugo Pradère','../');
    }

    public function contact()
    {
        $this->startTwig($this->viewPath, 'home.twig', null, null,  'Blog','../');
        $container = new Services();
        $container->sendEmail();
    }

    public function pageDoesntExists()
    {
        $this->startTwig(ROOT . '/App/AppDefault/views','404.twig', null, null, 'Ugo Pradère | 404', '../');
    }

    public function postDoesntExists()
    {
        $this->startTwig(ROOT . '/App/AppDefault/views','404.twig', null, null, 'Ugo Pradère | 404', '../../');
    }
}
