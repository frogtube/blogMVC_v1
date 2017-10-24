<?php

namespace Appdefault;


use Entity\Mail;
use MyFramework\Controller;
use Services\Services;

class DefaultController extends Controller
{

    public function __construct()
    {
        $this->viewPath = ROOT . '/App/AppDefault/views';
    }

    public function home($vars)
    {
        $this->startTwig($this->viewPath, 'home.twig', $vars, 'mail','Ugo Pradère','../');
    }

    public function contact()
    {
        $mail = new Mail($_POST);
        if($mail->isValid())
        {
            $mail->sendEmail();
            header("Location: ../web/");
        }
        else
        {
            $_POST['errors'] = $mail->getErrors();
            $this->home($_POST);
        }
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
