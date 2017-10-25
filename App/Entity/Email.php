<?php

namespace Entity;


use MyFramework\Entity;

class Email extends Entity
{
    // Vars corresponding to contactForm fields
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $message;

    // Check if the form was correctly filled in
    public function isValid()
    {
        return !(empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->message));
    }

    // Send an email
    public function sendEmail()
    {
        mail(   'u.pradere@gmail.com',
            'Contact : ' . $this->firstname() . ' ' . $this->lastname() . ' | ' . $this->email(),
            $this->message()
        );
    }

    // GETTERS
    public function firstname() { return $this->firstname; }
    public function lastname() { return $this->lastname; }
    public function email() { return $this->email; }
    public function message() { return $this->message; }

    // SETTERS with appropriate verification on user's input
    public function setFirstname($firstname)
    {
        if(is_string($firstname))
        {
            if(strlen($firstname)<50)
            {
                $this->firstname = $firstname;
            }
            else
            {
                $this->errors[] = "Votre prénom doit contenir un maximum de 50 caratères";
            }
        }
    }

    public function setLastname($lastname)
    {
        if(is_string($lastname))
        {
            if(strlen($lastname)<50)
            {
                $this->lastname = $lastname;
            }
            else
            {
                $this->errors[] = "Votre nom doit contenir un maximum de 50 caratères";
            }
        }
    }

    public function setEmail($email)
    {
        if(is_string($email))
        {
            if(strlen($email)<50)
            {
                $this->email = $email;
            }
            else
            {
                $this->errors[] = "Votre email doit contenir un maximum de 50 caratères";
            }
        }
    }

    public function setMessage($message)
    {
        if(is_string($message))
        {
            if(strlen($message)<2000)
            {
                $this->message = $message;
            }
            else
            {
                $this->errors[] = "Votre message doit contenir un maximum de 2000 caratères";
            }
        }
    }
}