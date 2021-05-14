<?php

namespace App\Controllers;

class databaseController
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO("mysql:host=localhost;dbname=tickets;port=3307;charset=utf8mb4", "admin", "admin");
    }

    public function getConnexion() {
        return $this->connexion;
    }

}