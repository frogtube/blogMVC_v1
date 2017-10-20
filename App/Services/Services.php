<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 16/10/2017
 * Time: 08:12
 */

namespace Services;


class Services
{
    public function sendEmail()
    {

        mail(   'u.pradere@gmail.com',
                'Contact : ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . ' | ' . $_POST['email'],
                $_POST['content']
        );



        /*

        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587))
            ->setUsername('romain.lamot@gmail.com')
            ->setPassword('BU8uBfdzmCEb')
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message($_POST['firstname'] . ' ' . $_POST['lastname'] . ' vous a écrit un message'))
            ->setFrom($_POST['email'])
            ->setTo('u.pradere@gmail.com')
            ->setBody($_POST['content'])
        ;

        // Send the message
        $mailer->send($message);

        */
    }

}