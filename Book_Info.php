<?php
if (isset($_GET['ISBN'])) {
    $stmt = $pdo->prepare('SELECT * FROM books WHERE ISBN = ?');
    $stmt->execute([$_GET['ISBN']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        // Display error if the book does not exist
        exit('book does not exist!');
    }
} else {
    // Display error if the ISBN wasn't specified
    exit('book does not exist!');
}
?>
<!-- Display book info -->
    <div>
        <h1><?=$book['Title']?></h1>
        <span>&dollar;<?=$book['Price']?></span><br>
        <span><?=$book['Author']?></span><br>
        <span><?=$book['Publisher']?></span><br>
        <span><?=$book['ISBN']?></span><br>
<!-- Add to cart form -->
        <form action="Store.php?page=cart" method="post">
            <input type="hidden" name="ISBN" value="<?=$book['ISBN']?>">
            <input type="submit" value="Add To Cart">
        </form>
        
    </div>
