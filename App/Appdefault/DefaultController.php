<?php

namespace Appdefault;


use Entity\Email;
use MyFramework\Controller;

class DefaultController extends Controller
{

    public function __construct()
    {
        $this->viewPath = ROOT . '/App/AppDefault/views';
    }

    // Display homepage
    public function home($vars)
    {
        $this->startTwig($this->viewPath, 'home.twig', $vars, 'mail','Ugo Pradère','../');
    }

    // Send an email through the contact form on homepage
    public function contact()
    {
        $mail = new Email($_POST);
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

    // Display the 404 error page when the requested page does not exists
    public function pageDoesntExists()
    {
        $this->startTwig(ROOT . '/App/AppDefault/views','404.twig', null, null, 'Ugo Pradère | 404', '../');
    }

    // Display the 404 error page when the requested article does not exists
    public function postDoesntExists()
    {
        $this->startTwig(ROOT . '/App/AppDefault/views','404.twig', null, null, 'Ugo Pradère | 404', '../../');
    }
}
