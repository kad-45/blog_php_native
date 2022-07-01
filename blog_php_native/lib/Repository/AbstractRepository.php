<?php

abstract class AbstractRepository
{
        private const DATABASE_NAME = "mysql:host=localhost;port=3306; dbname=micro_framework";
        private const DATABAS_USERNAME = "root";
        private const DATABASE_PASSWORD = "";

        /**
         * Initialise PDO connection with database
         */
        private function  connect()
        {
          $db = new PDO(self::DATABASE_NAME, self::DATABAS_USERNAME, self::DATABASE_PASSWORD);
          $db->exec("SET NAMES utf8");

          return $db;
        }


        protected function executeQuery(string $query, string $class, array $params = [])
        {
          //Connexion au base de donnée.
          $connexion = $this->connect();
          //Préparation de la requêtte.
          $statment = $connexion->prepare($query);
          foreach ($params as $key => $value) {
            //bindValue() Associe une valeur à un nom correspondant ou à un point d'interrogation (comme paramètre fictif) dans la requête SQL qui a été utilisé pour préparer la requête.
            $statment->bindValue($key, $value);
          }
          //La méthode d'exécution est requise pour envoyer la demande d'opération CRUD au serveur MySQL.
          $statment->execute();
          $result = null;
          $statment->setFetchMode(PDO::FETCH_CLASS, $class);
          //$nbrResult = $statment->rowCount();
           //return $statment->fetchAll();
           if ($statment->rowCount() === 1) $result = $statment->fetch();
           if ($statment->rowCount() > 1) $result = $statment->fetchAll();
   
           return $result;
      
          }
          
   
}