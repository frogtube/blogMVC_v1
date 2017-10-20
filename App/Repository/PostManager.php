<?php
/**
 * Created by PhpStorm.
 * User: ugo-fixe
 * Date: 06/10/2017
 * Time: 15:14
 */

namespace Model;

use Entity\Post;
use MyFramework\PDOFactory;

class PostManager extends PDOFactory
{

    public function getList()
    {
        $req = $this->getPDO()->query('SELECT * FROM post ORDER BY creationDate DESC');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Post');
        $data = $req->fetchAll();
        return $data;
    }

    public function getUnique($slug)
    {
        $req = $this->getPDO()->prepare('SELECT * FROM post WHERE slug = :slug');
        $req->bindValue(':slug', (string) $slug, \PDO::PARAM_STR);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Post');

        if ($post = $req->fetch())
        {
            return $post;
        }
        return null;

    }

    public function delete($slug)
    {
        $this->getPDO()->exec('DELETE FROM post WHERE id = '.(string) $slug);
    }

    public function executeSave($post)
    {

        $req = $this->getPDO()->prepare('
            UPDATE post 
            SET id = :id, author= :author, title = :title, chapo = :chapo, slug = :slug, content = :content, modificationDate = NOW() 
            WHERE id = :id'
        );

        $req->bindValue(':id', $post->id(), \PDO::PARAM_INT);
        $req->bindValue(':author', $post->author());
        $req->bindValue(':title', $post->title());
        $req->bindValue(':chapo', $post->chapo());
        $req->bindValue(':slug', (string) $post->slug(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->content());

        $req->execute();
    }

    public function executeAdd($post)
    {
        $req = $this->getPDO()->prepare('
            INSERT INTO post 
            SET author= :author, title = :title, chapo = :chapo, slug = :slug, content = :content, creationDate = NOW()'
        );

        $req->bindValue(':author', $post->author());
        $req->bindValue(':title', $post->title());
        $req->bindValue(':chapo', $post->chapo());
        $req->bindValue(':slug', (string) $post->slug(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->content());

        $req->execute();
    }

    public function executeDelete($post)
    {
        $this->getPDO()->exec('DELETE FROM post WHERE id = '.(int) $post->id());
    }
}


