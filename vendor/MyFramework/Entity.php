<?php

namespace MyFramework;


abstract class Entity
{
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

    // Stock error messages to be displayed on views
    public function getErrors()
    {
        return $this->errors;
    }
}