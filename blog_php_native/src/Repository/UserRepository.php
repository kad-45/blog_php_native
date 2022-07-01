<?php
require_once dirname(__DIR__, 2)."/lib/Repository/AbstractRepository.php";
require_once dirname(__DIR__, 2)."/src/Model/User.php";
//Création de la classe fille UserRepository de la classe parent AbstractRepository.

class UserRepository extends AbstractRepository
{

            //protected string $table = 'user';
            
            public function __construct()
            {
                  //$this->table = $table;
            }
            
            public function findAll()
            {
                  $query = "SELECT * FROM  user;";
                  //$params = [":username" => $username];
                  $result = $this->executeQuery($query, 'user');
                  return $result;
              
            }
            
            //Méthode qui va ajouter des utilisateurs dans la base de donnée.
            public function addUser(User $user){
                  

                  $query = "INSERT INTO  `user`(`lastname`, `firstname`, `username`, `password`) VALUES (:lastname, :firstname, :username, :password);"; 
                  $params = [':lastname'=> $user->getLastname(),
                              ':firstname'=> $user->getFirstname(),
                              ':username'=> $user->getUsername(),
                              ':password'=> $user->getPassword()];
                  $this->executeQuery($query, "User", $params);
            }
            
            //Méthode qui vérifie si l'utilisateur exists ou non.
            public function existsUsername(string $username)
            {
                  $query = "SELECT * FROM `user` WHERE `username` = :username;"; 
                  $params = [":username" => $username];
                  return $this->executeQuery($query, "User", $params);
            }
            
            public function find($id)
            {
                  $query = "SELECT * FROM `user` WHERE `id` = :id;";
                  $params = [":id" => $id];
                  return $this->executeQuery($query, 'User', $params); 
            }
           
            

}
?>