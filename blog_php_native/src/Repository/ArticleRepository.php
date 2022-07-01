<?php 
require_once dirname(__DIR__, 2) . "/lib/Repository/AbstractRepository.php" ; 
require_once dirname(__DIR__,2) . "/src/Model/Article.php" ; 
?>
<?php 
//ArticleRepository qui la classe enfant de la class parent AbstractRepository.
class ArticleRepository extends AbstractRepository {
      
  
          const ARTICLE_TABLE = "CREATE TABLE IF NOT EXISTS article(
                id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(255),
                publishedDate DATETIME
                );";
          
          const ARTICLE_INSERT = "INSERT INTO article(title, content, publishedDate) VALUE 
          ('sunt aut facere repellat provident occaecati excepturi optio reprehenderit, est rerum tempore vitae\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\nqui aperiam non debitis possimus qui neque nisi nulla, CURRENT_TIMESTAMP'),
          ('sunt aut facere repellat provident occaecati excepturi optio reprehenderit, est rerum tempore vitae\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\nqui aperiam non debitis possimus qui neque nisi nulla, CURRENT_TIMESTAMP'),
          ('sunt aut facere repellat provident occaecati excepturi optio reprehenderit, est rerum tempore vitae\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\nqui aperiam non debitis possimus qui neque nisi nulla, CURRENT_TIMESTAMP');"; 

          //public string $table = 'article';

          public function __construct()
          {
            //$this->table = $table;
          }
          public function findAll(){

              $query = "SELECT * FROM article ;";
              $result = $this->executeQuery($query, 'Article');
              return $result;
                  
            }

          public function find($id)
          {
              $query = "SELECT * FROM article WHERE id = :id;";
              $params = [":id" => $id];
              return  $this->executeQuery($query, 'article', $params);
            
          }
          
          public function add(Article $article)
          {
              $query = "INSERT INTO article(title, content, date_published, user_id, file_path_image) 
                        VALUES(:title, :content, :date_published, :user_id, :file_path_image);";
              $params = [
                  ":title" => $article->getTitle(),
                  ":content" => $article->getContent(),
                  ":date_published" => $article->getPublishedDate(),
                  ":user_id" => $article->getUserId(),
                  ":file_path_image" => $article->getFile_path_image()
              ];
      
              return $this->executeQuery($query, "Article", $params);
          }

          public function findLast()
          {
              $query = "SELECT * FROM article ORDER BY id DESC LIMIT 1;";
              return  $this->executeQuery($query, "Article");
          }
          
          public function insertCategory($article, $category)
          {
              $query = "INSERT INTO article_category(article_id, category_id) 
                        VALUES(:article_id, :category_id);";
              $params = [
                  ":article_id" => $article->getId(),
                  ":category_id" => $category->getId() ?? []
                  ];

              return  $this->executeQuery($query, " ", $params);
          }

          public function deleted(Article $article)
          {
            //supprime les lignes de l'article_category lié à l'article et l'article via son id.
            $query = "DELETE FROM article_category WHERE article_id = :article_id;";
            $params = [":article_id" => $article->getId()];
            $this->executeQuery($query, "Article", $params);
            
            //supprime la ligne de l'article via son id.
            $query = "DELETE FROM article WHERE id =:id;";
            $params = [":id" => $article->getId()];
            var_dump($params);
            return $this->executeQuery($query, "Article", $params);
          }




  
}
?>