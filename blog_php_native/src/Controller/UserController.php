<?php
require_once dirname(__DIR__, 2) . "/lib/Controller/AbstractController.php";
require_once dirname(__DIR__) . "/Repository/UserRepository.php";
?>
<?php
class UserController extends AbstractController
{
  /**
     * @return string utilise la methode renderView() définie dans la classe abstrait parent AbstractController. 
     */



    //Méthode pour ajouter des utilisateurs
    public function add()
      {
        //On va traiter le formulaire.
      if(!empty($_POST)){
          //Post n'est pas vide on vérifie que toutes les données sont existant.
        if(isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'])
          && !empty($_POST['firstname'])
          && !empty($_POST['lastname'])
          && !empty($_POST['username'])
          && !empty($_POST['password'])
          ){
          //Le forfmulaire est complet
          //On récupère les données et on va les protéger(faille XSS).
          //strip_tags() — Supprime les balises HTML et PHP d'une chaîne.
          $firstname = strip_tags($_POST['firstname']);
          $lastname = strip_tags($_POST['lastname']);
          $username = strip_tags($_POST['username']);
          $password = strip_tags($_POST['password']);

          //instanciation de la classe User 
          $user = new User();
          $user->setLastname($lastname);
          $user->setFirstname($firstname);
          $user->setUsername($username);
          $user->setPassword($password);
          $userRepository = new UserRepository('user') ;
          if(empty($userRepository->existsUsername($username))) {
              $userRepository->addUser($user);
          } else {
            echo " Veuillez changer ce username : existe dèjà!";
          }
        

          
         // $users = $userRepository->findAll();
          //$password =  password_hash($password, PASSWORD_BCRYPT,  ["cost" => 12]);
          
        

        }else {
          echo "<span style ='background-color :red; color : white; font-size :18px;'>"."Le forulaire est incomplet"."</span>";
        }
    } 


        $userRepository = new UserRepository('user');
        $users = $userRepository->findAll();
        $this->renderView("/template/Users/user_add.phtml", ["users" => $users]);
  }

    public function connexion(): bool
      {
        $error = null;
        //On verifie si tous les champs requis sont remplis.
        if (
          isset($_POST['username'], $_POST['password'])
          && !empty($_POST['username'])
          && !empty($_POST['password'])
        ) {
          $userRepository = new UserRepository('user');
          //$pass = password_hash($_POST['password'], PASSWORD_BCRYPT,  ["cost" => 12]);
          $user = $userRepository->existsUsername($_POST['username']);
          //password_verify — Vérifie qu'un mot de passe correspond à un hachage.
          if (
            !empty($user)
            && password_verify($_POST['password'], $user->getPassword())
          ) {
            
            $_SESSION['user_is_connected'] = true;
            $_SESSION['user_id'] = $user->getId();
            //header() permet de spécifier l'en-tête HTTP string lors de l'envoi des fichiers HTML.
            header('Location: /?page=home ');
            echo "<div class='alert alert-success' role='alert'>Vous êtes connecté</div>";

            } else {
              echo "<div class='alert alert-danger' role='alert'>Identifiant ou mot de passe incorrect</div>";
            }
          }
        
          return $this->renderView("/template/Users/user_connexion.phtml", ['error' => $error]);
      }

        //Création d'une Méthode de deconnection.
    function disconnect()
      {
          //unset() détruit la ou les variables dont le nom a été passé en argument
          unset($_SESSION['user_is_connected']);
          header("Location: /?page=home");
      }
}