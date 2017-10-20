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

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->content) || empty($this->chapo) || empty($this->chapo));
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
            $this->author = $author;
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
            $this->title = $title;
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
            $this->chapo = $chapo;
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
            $this->content = $content;
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
            $this->slug = $slug;
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
        $this->creationDate = $creationDate;
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
        $this->modificationDate = $modificationDate;
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
     */
    public function offsetExists($key)
    {
        return isset($this->tableau[$key]);
    }

    /**
     * Retourne la valeur de la clé demandée.
     * Une notice sera émise si la clé n'existe pas, comme pour les vrais tableaux.
     */
    public function offsetGet($key)
    {
        return $this->tableau[$key];
    }

    /**
     * Assigne une valeur à une entrée.
     */
    public function offsetSet($key, $value)
    {
        $this->tableau[$key] = $value;
    }

    /**
     * Supprime une entrée et émettra une erreur si elle n'existe pas, comme pour les vrais tableaux.
     */
    public function offsetUnset($key)
    {
        unset($this->tableau[$key]);
    }
}