<?php
require_once "../classes/book.php";
$bookObj = new Book();

$search = "";
$genre = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $search = isset($_GET["search"]) ? trim(htmlspecialchars($_GET["search"])) : "";
    $genre = isset($_GET["genre"]) ? trim(htmlspecialchars($_GET["genre"])) : "";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>

</head>
<body>
    <div class="container">
        <h1>VIEW BOOKS</h1>
        <div class="search-container">
            <form action="" method="get">
                <label for="search">Search: </label>
                <input type="search" name="search" id="search" value="<?= $search ?>">
                <select name="genre" id="genre">
                    <option value="" <?= empty($genre) ? "selected" : ""; ?>>-- Select Option --</option>
                    <option value="History" <?= $genre == "History" ? "selected" : ""; ?>>History</option>
                    <option value="Science" <?= $genre == "Science" ? "selected" : ""; ?>>Science</option>
                    <option value="Fiction" <?= $genre == "Fiction" ? "selected" : ""; ?>>Fiction</option>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="table-container">
            <button><a href="addBook.php">Add Book</a></button>
            <table border="1">
                <tr class="header">
                    <td>id</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Genre</td>
                    <td>Publication Year</td>
                </tr>
        
                <?php 
                $no = 1;
                foreach($bookObj->viewBook($genre, $search) as $book) { // extra parameter
                ?>
                <tr class="data">
                    <td><?= $no++ ?></td>
                    <td><?= $book["title"] ?></td>
                    <td><?= $book["author"]  ?></td>
                    <td><?= $book["genre"]  ?></td>
                    <td><?= $book["publication_year"] ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>