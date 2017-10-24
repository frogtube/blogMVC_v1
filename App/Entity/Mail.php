<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 24/10/2017
 * Time: 11:42
 */

namespace Entity;


class Mail
{
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $message;
    protected $errors = [];

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }

    public function isValid()
    {
        return !(empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->message));
    }

    public function sendEmail()
    {
        mail(   'u.pradere@gmail.com',
            'Contact : ' . $this->firstname() . ' ' . $this->lastname() . ' | ' . $this->email(),
            $this->message()
        );
    }


        /**
     * @return mixed
     */
    public function firstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        if(is_string($firstname))
        {
            if(strlen($firstname)<50)
            {
                $this->firstname = $firstname;
            }
        }
        else
        {
            $this->errors[] = "Votre prénom doit contenir un maximum de 50 caratères";
        }
    }

    /**
     * @return mixed
     */
    public function lastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        if(is_string($lastname))
        {
            if(strlen($lastname)<50)
            {
                $this->lastname = $lastname;
            }
        }
        else
        {
            $this->errors[] = "Votre nom doit contenir un maximum de 50 caratères";
        }
    }

    /**
     * @return mixed
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        if(is_string($email))
        {
            if(strlen($email)<50)
            {
                $this->email = $email;
            }
        }
        else
        {
            $this->errors[] = "Votre email doit contenir un maximum de 50 caratères";
        }
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        if(is_string($message))
        {
            if(strlen($message)<2000)
            {
                $this->message = $message;
            }
        }
        else
        {
            $this->errors[] = "Votre message doit contenir un maximum de 2000 caratères";
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}