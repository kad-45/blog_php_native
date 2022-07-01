<?php
// Création de la class Catégory.

class Category
{
      private int $id;
      private string $name;

      public function __construct()
      {
         //$this->id = $id;
        //$this->name = $name;
      }
      
      public function getId(): int
      {
        return $this->id;
        
      }
      
      public function getName(): string
      {
        return $this->name;
      }
      public function setName(string $name): void
      {
        $this->name = $name;
      }

  
}


?>