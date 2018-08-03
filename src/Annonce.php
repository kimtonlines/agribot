<?php
/**
 * Created by PhpStorm.
 * User: Kimt
 * Date: 01/08/2018
 * Time: 14:54
 */

namespace AgriBot;


use PDO;

class Annonce
{
    private $id;
    private $title;
    private $description;
    private $budget;
    private $status;
    private $slug;
    private $created_at;
    private $updated_at;

    private $etat_id;
    private $category_id;
    private $user_id;

    private $price;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget): void
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getEtatId()
    {
        return $this->etat_id;
    }

    /**
     * @param mixed $etat_id
     */
    public function setEtatId($etat_id): void
    {
        $this->etat_id = $etat_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $update_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }



    public function add()
    {
        //$select = $this->database->query('SELECT * FROM annonces');
        //$res = $select->fetchAll();

        $db = Database::getConnection();

        $pdoStatement = $db->prepare
        ('
         INSERT INTO annonces(title, description, slug, status, etat_id, category_id, user_id, budget, price, created_at, updated_at)
          VALUES(:title, :description, :slug, :status, :etat_id,  :category_id, :user_id, :budget, :price, :created_at, :updated_at)
           ');

        $pdoStatement->bindValue(':title', $this->title);
        $pdoStatement->bindValue(':description', $this->description);
        $pdoStatement->bindValue(':slug',  $this->slug);
        $pdoStatement->bindValue(':budget', $this->budget);
        $pdoStatement->bindValue(':status', $this->status);
        $pdoStatement->bindValue(':category_id', $this->category_id);
        $pdoStatement->bindValue(':user_id', $this->user_id);
        $pdoStatement->bindValue(':price', $this->price);
        $pdoStatement->bindValue(':etat_id', $this->etat_id);
        $pdoStatement->bindValue(':created_at', $this->created_at);
        $pdoStatement->bindValue(':updated_at', $this->updated_at);

        $res = $pdoStatement->execute();

        if ($res)
        {
            dd("Annonce ajoutée!");
        }
        else
        {
            dd("Error");
        }
    }

}

