<?php 
    session_start();
    include 'DBconnection.php';
    $pdo = connectDB();
    $sql = "DELETE FROM users WHERE UserID = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['uID']]);
    $_SESSION['location'] = "DeletedAcc";
    header("location:Summary.php");
?>