<?php
require_once "database.php";

class Book extends Database{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";

    protected $db;

    
    public function addBook() {
        $sql = "INSERT INTO books (title, author, genre, publication_year) VALUE (:title, :author, :genre, :publication_year)";

        $query = $this->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        
        return $query->execute();
    }

    public function viewBook($genre="", $search="") {
        $sql = "SELECT * FROM books WHERE title LIKE CONCAT('%', :search, '%')";
        
        if(!empty($genre)) { // concats additional query to main query for filtering by books
            $sql .= " AND genre = :genre";
        }

        $sql .= " ORDER BY title ASC"; // ORDER the books

        $query = $this->connect()->prepare($sql);
        $query->bindParam(":search", $search);

        if(!empty($genre)) { // bind genre
            $query->bindParam(":genre", $genre);
        }
        if($query->execute()){
            return $query->fetchAll();
        }else{
            return null;
        }
    }
    
    public function isBookExist($bTitle){
        $sql = "SELECT COUNT(*) as total_books FROM books WHERE title = :title";
        $query = $this->connect()->prepare($sql);

        $query->bindParam(":title", $bTitle);
        $record = NULL;

        if ($query->execute()) {
            $record = $query->fetch();
        }
        
        if($record["total_books"] > 0){
            return true;
        }else{
            return false;
        }

    }
    
}