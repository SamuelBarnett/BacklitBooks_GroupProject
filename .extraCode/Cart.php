<?php
// If the user clicked the add to cart button on the book info page we check the form data
if (isset($_POST['ISBN'])){
    $ISBN = $_POST['ISBN'];

    $sql = "SELECT * FROM books WHERE ISBN = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['ISBN']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
        if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
            if(array_key_exists($ISBN, $_SESSION['cart'])){
                echo "Book already in cart";
            }else{
                $_SESSION['cart'][$ISBN] = $row['Title'];
            }
        }else{
            $_SESSION['cart'] = array($ISBN => $row['Title']);
        }
    }

    // Prevent form resubmission
    header('location: Store.php?page=cart');
    exit;
    
}

// Remove book from cart
if (isset($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the book from the cart session
    unset($_SESSION['cart'][$_GET['remove']]);
    
}

// checks session for books in cart
$books_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$books = array();
$total = 0;

// display the books in the cart
if($books_in_cart){

    $array_to_question_marks = implode(',', array_fill(0, count($books_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM books WHERE ISBN IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($books_in_cart));
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($books as $book) {
        $total += $book['Price'];
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="Cart.css" />
        <title>Place Order</title>
        <style></style>
    </head>
    <body>
        <div class="content-Wrapper">
            <h1 class="cart-title">Shopping cart</h1>
            <form action="Store.php?page=cart" method="post">
                <table id="cart-wrapper">
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="3" class="total">**There are no books in your cart**</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach($books as $book):?>
                        <tr>
                            <td class="book-info">
                                <div class="book_cover">
                                    <a href = "Store.php?page=Book_Info&ISBN=<?=$book['ISBN']?>"><img src="<?=$book['ImageURL']?>" class="cover-image"></a>
                                </div>
                                <table>
                                    <tr>
                                        <td><a href= "Store.php?page=Book_Info&ISBN=<?=$book['ISBN']?>" class="title-link"><?=$book['Title']?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Author: <?=$book['Author']?></td>
                                    </tr>
                                    <tr>
                                        <td>Published By: <?=$book['Publisher']?></td>
                                    </tr>
                                    <tr>
                                        <td>ISBN: <?=$book['ISBN']?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php for ($i = 0; $i < $book['Rating']; $i++): ?> 
                                            <i class="fa fa-star"></i>
                                            <?php endfor; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="remove"><a href="Store.php?page=cart&remove=<?=$book['ISBN']?>"><i class="fa fa-trash-o"></i></a></td>
                            <td class="price">&dollar;<?=$book['Price']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="3" class="total">Subtotal: &dollar;<?=$total?></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div id="status_container">
            <div class="status">1. Place Order</div>
            <div class="status" style="background-color:#62050065">2. Payment Info</div>
            <div class="status" style="background-color:#62050065">3. Confrim Order</div>
        </div>
        <form action="">
            <table style="margin-left: auto; margin-right:auto;">
                <tr>
                    <td><button type="submit">Cancel</button></td>
                    <td><button type="submit">Continue</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>
