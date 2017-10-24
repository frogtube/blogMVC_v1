<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 06/10/2017
 * Time: 16:08
 */

namespace Entity;

class Post
{
    protected $id;
    protected $author;
    protected $title;
    protected $chapo;
    protected $content;
    protected $slug;
    protected $creationDate;
    protected $modificationDate;
    protected $errors = [];

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->content) || empty($this->chapo) || empty($this->slug));
    }

    public function id() { return $this->id; }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
        {
            $this->id = $id;
        }
    }

    /**
     * @return mixed
     */
    public function author()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        if(is_string($author))
        {
            if(strlen($author)<50)
            {
                $this->author = $author;
            }
            else
            {
                $this->errors[] = "Le nom de l'auteur ne peut exéder 50 caractères";
            }
        }
    }

    /**
     * @return mixed
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        if(is_string($title))
        {
            if(strlen($title)<250)
            {
                $this->title = $title;
            }
            else
            {
                $this->errors[] = "Le titre de l'article ne peut exéder 250 caractères";
            }
        }
    }

    /**
     * @return mixed
     */
    public function chapo()
    {
        return $this->chapo;
    }

    /**
     * @param mixed $title
     */
    public function setChapo($chapo)
    {
        if(is_string($chapo))
        {
            if(strlen($chapo)<250)
            {
                $this->chapo = $chapo;
            }
            else
            {
                $this->errors[] = "Le chapô de l'article ne peut exéder 250 caractères";
            }
        }
    }

    /**
     * @return mixed
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        if(is_string($content))
        {
            if(strlen($content)<2000)
            {
                $this->content = $content;
            }
            else
            {
                $this->errors[] = "Le contenu de l'article ne peut exéder 2000 caractères";
            }
        }
    }

    /**
     * @return mixed
     */
    public function slug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        if(is_string($slug))
        {
            if(strlen($slug)<250)
            {
                $this->slug = $slug;
            }
        }
    }

    /**
     * @return mixed
     */
    public function creationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        if(is_string($creationDate))
        {
            if(strlen($creationDate)<20)
            {
                $this->creationDate = $creationDate;
            }
        }
    }

    /**
     * @return mixed
     */
    public function modificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param mixed $modificationDate
     */
    public function setModificationDate($modificationDate)
    {
        if(is_string($modificationDate))
        {
            if(strlen($modificationDate)<20)
            {
                $this->modificationDate = $modificationDate;
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
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

    /* MÉTHODES DE L'INTERFACE ArrayAccess */


    /**
     * Vérifie si la clé existe.

    public function offsetExists($key)
    {
        return isset($this->tableau[$key]);
    }
     */
    /**
     * Retourne la valeur de la clé demandée.
     * Une notice sera émise si la clé n'existe pas, comme pour les vrais tableaux.

    public function offsetGet($key)
    {
        return $this->tableau[$key];
    }
     */
    /**
     * Assigne une valeur à une entrée.

    public function offsetSet($key, $value)
    {
        $this->tableau[$key] = $value;
    }
     */
    /**
     * Supprime une entrée et émettra une erreur si elle n'existe pas, comme pour les vrais tableaux.

    public function offsetUnset($key)
    {
        unset($this->tableau[$key]);
    }
     */
}