<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 13/10/2017
 * Time: 11:11
 */

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

    public function home()
    {
        $this->startTwig($this->viewPath, 'home.twig', null, null,'Ugo Pradère','../');
    }

    public function contact($mail)
    {
        $this->startTwig($this->viewPath, 'home.twig', $mail, 'mail',  'Blog','../');

        $mail = new Mail($_POST);
        if($mail->isValid())
        {
            $mail->sendEmail();
        }
        else
        {
            $_POST['errors'] = $mail->getErrors();
            $this->contact($_POST);
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
