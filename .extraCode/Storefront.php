<?php 
    // sql for most popular
    $sql = "SELECT * FROM books LIMIT 5;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // sql for highest rated
    $sql = "SELECT * FROM books WHERE Rating = 5 LIMIT 5;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rated_books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="Storefront.css" />
        <title>Storefront</title>
        <style></style>
    </head>
    <body>
        <!-- form for testing search algorithm -->
        <form action="Search.php" method="GET">
            <input type="text" placeholder="Search the Backlit Books Store" name="search_term">
            <button type = "submit" name="search" value="submit">Search</button>
        </form>
        <div class="content-wrapper">
            <div class="store-header">
                <h2>Most popular</h2>
            </div>
            <!-- Displayng the books using a for loop -->
            <?php foreach ($rows as $books): ?>
            <div class="book-wrapper">
                <div class="book-cover">
                    <a href="Store.php?page=Book_Info&ISBN=<?=$books['ISBN']?>" class="title-link"><img src="<?=$books['ImageURL']?>" class="cover-image"></a>
                </div>
                <table class="book-info">
                    <tr>
                        <td><a href="Store.php?page=Book_Info&ISBN=<?=$books['ISBN']?>" class="title-link"><span><?=$books['Title']?></span></a></td>
                    </tr>
                    <tr>
                        <td>by <?=$books['Author']?></td>
                    </tr>
                    <tr> <!-- this is for displaying the star rating from the database -->
                        <td>
                            <?php for ($i = 0; $i < $books['Rating']; $i++): ?> 
                            <i class="fa fa-star"></i>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span>&dollar;<?=$books['Price']?></span></td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
            <div class="store-header">
                <h2>Highest Rated</h2>
            </div>
            <?php foreach ($rated_books as $books): ?>
            <div class="book-wrapper">
            <div class="book-cover">
                    <a href="Store.php?page=Book_Info&ISBN=<?=$books['ISBN']?>" class="title-link"><img src="<?=$books['ImageURL']?>" class="cover-image"></a>
                </div>
                <table class="book-info">
                    <tr>
                        <td><a href="Store.php?page=Book_Info&ISBN=<?=$books['ISBN']?>" class="title-link"><span><?=$books['Title']?></span></a></td>
                    </tr>
                    <tr>
                        <td>
                            <?php for ($i = 0; $i < $books['Rating']; $i++): ?> 
                            <i class="fa fa-star"></i>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span>&dollar;<?=$books['Price']?></span></td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>