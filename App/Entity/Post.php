<?php

namespace Entity;

use MyFramework\Entity;

class Post extends Entity
{
    protected $id;
    protected $author;
    protected $title;
    protected $chapo;
    protected $content;
    protected $slug;
    protected $creationDate;
    protected $modificationDate;


    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->content) || empty($this->chapo) || empty($this->slug));
    }

    //GETTERS
    public function id() { return $this->id; }
    public function author() { return $this->author; }
    public function title() { return $this->title; }
    public function chapo() { return $this->chapo; }
    public function content() { return $this->content; }
    public function slug() { return $this->slug; }
    public function creationDate() { return $this->creationDate; }
    public function modificationDate() { return $this->modificationDate; }

    //SETTERS
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
        {
            $this->id = $id;
        }
    }

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
}