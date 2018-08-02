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

    private $etat_id;
    private $category_id;
    private $user_id;

    private $price;

    private $database;

    public function __construct()
    {
        $this->database = new PDO('mysql:dbname=heroku_526741e4a3bcedf;host=us-cdbr-iron-east-04.cleardb.net', 'bc7b958cdd6a45', 'a82c899a');
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


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

    public function add()
    {
        $select = $this->database->query('SELECT * FROM annonces');
        dd($select);
        $pdoStatement = $this->database->prepare
        ('
          INSERT INTO annonces (title, description, budget, status, slug, category_id, user_id, price)
          VALUES (:title, :description, :budget, :status, :slug, :category_id, :user_id, :price )
           ');

        $pdoStatement->bindParam('title',$this->title);
        $pdoStatement->bindParam('description',$this->description);
        $pdoStatement->bindParam('budget',$this->budget);
        $pdoStatement->bindParam('status',$this->status);
        $pdoStatement->bindParam('slug',$this->slug);
        $pdoStatement->bindParam('category_id',$this->category_id);
        $pdoStatement->bindParam('user_id',$this->user_id);
        $pdoStatement->bindParam('price',$this->price);

        $pdoStatement->execute();
    }

}

