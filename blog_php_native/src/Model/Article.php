<?php 
//Article est le model de la table article qui se trouve dans la base de donnée micro-framework.
class Article 
{
     private  int $id;
     private ?string $title;
     private ?string $content;
     private ?string $date_published;
     private int $user_id;
     private $file_path_image;
     
     public function __construct()
     {
     }
     
     public function getId(): int
     {
           return $this->id;
     }
     
     
     public function getTitle(): ?string
     {
          return $this->title; 
     }
     public function setTitle(string $title): void
     {
            $this->title = $title;
     }
     public function getContent(): ?string
     {
          return $this->content; 
     }
     public function setContent(string $content): void
     {
            $this->content = $content;
     }
     public function getPublishedDate(): ?string
     {
           return $this->date_published;
     }
     public function setPublishedDate(string $date_published): void
     {
            $this->date_published = $date_published;
     }
     public function getUserId(): int
     {
            return $this->user_id;
     }
     public function setUserId (int $user_id): void
     {
            $this->user_id = $user_id;
     }
     public function getFile_path_image()
     {
            return $this->file_path_image;
     }
     public function setFile_path_image($file_path_image): void
     {
            $this->file_path_image = $file_path_image;
     }
     
     
     
     


  
}

?>