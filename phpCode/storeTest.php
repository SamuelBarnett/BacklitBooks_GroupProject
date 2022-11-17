<?php
session_start();

$_SESSION['store'] = true;

// include 'DBconnection.php';
// $pdo = connectDB();

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/53a095ce36.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./styles/main.css" />
    <title>Storefront</title>
    <style></style>
</head>

<body>
    <!-- form for testing search algorithm -->
    <?php include 'header.php'; ?>

    <div class="content-wrapper">
        <div class="store-header">
            <h2>Most popular</h2>
        </div>
        <!--`````````````````````` Displaying one book for design ``````````````````````````````````-->
        <div class="book-wrapper">
            <div class="book-cover">
                <a href="Store.php?page=Book_Info&ISBN=<?= $books['ISBN'] ?>" class="title-link"><img src="<?= $books['ImageURL'] ?>" class="cover-image"></a>
            </div>
            <table class="book-info">
                <tr>
                    <td><a href="Login.php">example link</a></td>
                </tr>
                <tr>
                    <td>by Joe</td>
                </tr>
                <tr>
                    <!-- this is for displaying the star rating from the database -->
                    <td>
                        <i class="fa fa-star"></i>
                    </td>
                </tr>
                <tr>
                    <td><span>&dollar;20</span></td>
                </tr>
            </table>
        </div>

        <!-- ````````````````````````````````````````````````````````````````````````````````````` -->

        <!-- Displaying the books using a for loop -->
        <?php foreach ($rows as $books) : ?>
            <div class="book-wrapper">
                <div class="book-cover">
                    <a href="Store.php?page=Book_Info&ISBN=<?= $books['ISBN'] ?>" class="title-link"><img src="<?= $books['ImageURL'] ?>" class="cover-image"></a>
                </div>
                <table class="book-info">
                    <tr>
                        <td><a href="Store.php?page=Book_Info&ISBN=<?= $books['ISBN'] ?>" class="title-link"><span><?= $books['Title'] ?></span></a></td>
                    </tr>
                    <tr>
                        <td>by <?= $books['Author'] ?></td>
                    </tr>
                    <tr>
                        <!-- this is for displaying the star rating from the database -->
                        <td>
                            <?php for ($i = 0; $i < $books['Rating']; $i++) : ?>
                                <i class="fa fa-star"></i>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span>&dollar;<?= $books['Price'] ?></span></td>
                    </tr>
                </table>
            </div>
        <?php endforeach; ?>
        <div class="store-header">
            <h2>Highest Rated</h2>
        </div>
        <?php foreach ($rated_books as $books) : ?>
            <div class="book-wrapper">
                <div class="book-cover">
                    <a href="Store.php?page=Book_Info&ISBN=<?= $books['ISBN'] ?>" class="title-link"><img src="<?= $books['ImageURL'] ?>" class="cover-image"></a>
                </div>
                <table class="book-info">
                    <tr>
                        <td><a href="Store.php?page=Book_Info&ISBN=<?= $books['ISBN'] ?>" class="title-link"><span><?= $books['Title'] ?></span></a></td>
                    </tr>
                    <tr>
                        <td>
                            <?php for ($i = 0; $i < $books['Rating']; $i++) : ?>
                                <i class="fa fa-star"></i>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span>&dollar;<?= $books['Price'] ?></span></td>
                    </tr>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>