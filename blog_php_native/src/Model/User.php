<?php 
//Créationde la class user.

class User 
{
      private int $id;
      private string $lastname;
      private string $firstname;
      private string $username;
      private string $password;
            
      public function __construct()
      {
      }
      public function getId(): int
      {
            return $this->id; 
      }
      /*public function setId(int $id): void
      {
            $this->id = $id;
            return $this;
      }*/
      public function getLastname(): ?string
      {
            return $this->lastname; 
      }
      public function setLastname(string $lastname): User
      {
            $this->lastname = $lastname;
            return $this;
      }
      public function getFirstname(): ?string
      {
            return $this->firstname;
      }
      public function setFirstname(string $firstname): User
      {
            $this->firstname = $firstname;
             return $this;
      }
      public function getUsername(): ?string
      {
            return $this->username;
      }
      public function setUsername(string $username): User
      {
            $this->username = $username;
            return $this;
      }
      public function getPassword(): ?string
      {
            return $this->password;
      }
      public function setPassword(?string $password): User
      {
            $this->password = $password= password_hash($password, PASSWORD_BCRYPT,  ["cost" => 12]);
            return $this;
      }
      }  
?>