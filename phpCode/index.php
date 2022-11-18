<?php
session_start();
// if (!isset($_SESSION['uID'])) {
//   header("Location:Login.php");
//   exit();
// }
var_dump($_SESSION['uID']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./styles/main.css" />
  <meta charset="UTF-8" />
  <script src="https://kit.fontawesome.com/53a095ce36.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Home page</title>
</head>

<?php
include 'header.php';
?>

<body>
  <main>
    <div id="indexDisplay">
      <div id="homeCenter">
        <blockquote>
          Improve your browsing and shopping experience through Backlit Books.
        </blockquote>
        <blockquote>
          A proof of concept of a what an e-commerce website can be.
        </blockquote>
      </div>
    </div>
    <div id="homeFade">
      <h1 class="subTitle">Recommendations</h1>
    </div>
    <div id="recommendations">
      <div class="homeImage">
        <img src="imgs/davinci.jpg" height="400" width="250" />
        <h3>The Davinci Code</h3>
      </div>

      <div class="homeImage">
        <img src="imgs/harryPotter.jpg" height="400" width="250" />
        <h3>Harry Potter and The Sorcerer's Stone</h3>
      </div>
      <div class="homeImage">
        <img src="imgs/1984.jpg" height="400" width="250" />
        <h3>1984</h3>
      </div>
    </div>
  </main>
  <div id="footerLine">
    <footer>Team 20</footer>
  </div>
</body>

</html>