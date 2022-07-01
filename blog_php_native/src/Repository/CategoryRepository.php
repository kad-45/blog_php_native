<?php 
require_once dirname(__DIR__, 2) . "/lib/Repository/AbstractRepository.php" ; 
require_once dirname(__DIR__, 2) . "/src/Model/Category.php" ; 
require_once dirname(__DIR__, 2) . "/src/Model/Article.php" ; 

?>
<?php
class CategoryRepository extends AbstractRepository
{

        //public string $table;
        public function __construct()
        {
          //$this->table = $table;
        } 
        public function findByArticleId($article)
        {

              $query = "SELECT id, name FROM category INNER JOIN article_category ON category.id = article_category.category_id WHERE 
              article_category.article_id = :article_id;";
              $params = [":article_id" =>$article->getId()];
              return $this->executeQuery($query, 'Category', $params);
        }
        
        public function find(int $id)
        {
              $query = "SELECT * FROM category WHERE id = :id;";
              $params = [":id" => $id];
              return  $this->executeQuery($query, "Category", $params);
        }
        
        public function findAll()
        {
               $query = "SELECT * FROM category;";
               return $this->executeQuery($query, "Category");
        }
}
?>