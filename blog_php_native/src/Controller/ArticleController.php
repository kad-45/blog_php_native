<?php
require_once dirname(__DIR__, 2) . "/lib/Controller/AbstractController.php";
require_once dirname(__DIR__, 2) . "/src/Repository/ArticleRepository.php";
require_once dirname(__DIR__, 2) . "/src/Repository/CategoryRepository.php";
require_once dirname(__DIR__, 2) . "/src/service/Service.php";

?>
<?php
class ArticleController extends AbstractController
{
            private ArticleRepository $articleRepository;
            
        public function __construct()
        {
            $this->articleRepository = new ArticleRepository;   
        }
        
        /**
         * @return string utilise la methode renderView() définie dans la classe abstrait parent AbstractController 
         */
        public function index()
        {
            $articleRepository = new ArticleRepository('article');
            $articles = $articleRepository->findAll();
            $this->renderView("/template/Articles/article.php", ["articles" => $articles]);
        }

        public function show()
        {
            $category = [];
            $article = NULL;
            $user = NULL;
            if (isset($_GET['id'])) {
                $articleRepository = new ArticleRepository();
                $article = $articleRepository->find($_GET['id']);

                $userRepository = new UserRepository();
                $user = $userRepository->find($article->getUserId());

                $categoryRepository = new CategoryRepository();
                $category = $categoryRepository->findByArticleId($article) ?? [];
            }
            return $this->renderView("/template/Articles/article_show.phtml", [
                "article" => $article,
                "user" => $user,
                "category" => $category
            ]);
        }
        //Méthode pour ajouter des articles.
        public function add()
        {
            $error = NULL;
            $message = "";
            $articleRepository = new ArticleRepository();
            $categoryRepository = new CategoryRepository();
            
            if (
                !empty($_POST)
                && isset($_POST["title"], $_POST["content"], $_POST["categories"])
                && !empty($_FILES["img"])
            ) {
            //Le forfmulaire est complet
            //On récupère les données et on va les protéger(faille XSS).
            //strip_tags() — Supprime les balises HTML et PHP d'une chaîne.
            $title = strip_tags($_POST["title"]);
            $content = strip_tags($_POST["content"]);
            $file_path_image = Service::moveFile($_FILES["img"]);
            $user_id = $_SESSION["user_id"];
                        
            
                $article = new Article();
                $article->setTitle($title);
                $article->setContent($content);
                $article->setPublishedDate((new DateTime("NOW"))->format("Y-m-d H:i:s"));
                $article->setUserId($user_id);
                $article->setFile_path_image($file_path_image);
                $articleRepository->add($article);
                $article = $articleRepository->findLast();
                $category = Service::checkCategoriesExist($_POST["categories"]);
                foreach ($category as $key => $category) {
                    $articleRepository->insertCategory($article, $category);
                }
                // header("Location: /?page=article");
            }

            return $this->renderView("/template/Articles/article_add.phtml", [
                "error" => $error,
                "message" => $message,
                "categories" => $categoryRepository->findAll()
            ]);
        }
        
        public function deleted()
        {
            if (Service::checkIfUserIsConnected()
                && !empty($_GET["article_id"])
                && isset($_GET["article_id"])
                && $article = $this->articleRepository->find($_GET["article_id"])
                ) {
                    //unlink — Supprime un fichier et retourn un boolen.
                unlink((dirname(__DIR__,2))."/public/".$article->getFile_path_image());
                
                $this->articleRepository->deleted($article);   


                }
                header("Location:/?page=article");
                
        }
}   
?>