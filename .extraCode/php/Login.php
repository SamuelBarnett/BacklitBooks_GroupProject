<!-- This html was just a placeholder in order for me to test that the database connection works  -->
<!-- WHOMEVER IS WORKING ON THE FRONT END NEEDS TO REPLACE THIS -->
<?php

require 'DBconnection.php';
// require 'ECommerce.php';
// create session
session_start();
// initialize user ID and user name session objects
$_SESSION['uID'] = "default";
$_SESSION['username'] = "default";

// establish connection
$pdo = connectDB();

// If the form is submitting perform the operations in the brackets.
if (isset($_POST['login'])) {

  // declare variable and grab by form element name
  $username = $_POST['username'];
  $password = $_POST['psw'];

  // sql query to grab user id, name and password by inputed username
  $sql = "SELECT UserID, UserName, psw from users WHERE UserName = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);

  while ($row = $stmt->fetch()) {


    // if user entered username matches the username in the DB
    if ($username == $row['UserName']) {
      // if user entered password mathches the hashed password in the DB
      if (password_verify($password, $row['psw'])) {
        // Add username and userID to the session
        $_SESSION['uID'] = $row['UserID'];
        $_SESSION['username'] = $row['UserName'];
        // redirect the user to the store page
        header("Location:Store.php");
      } else {
        // else display invalid password error message
        echo "invalid password";
      }
    } else if ($row['UserName'] == null) {
      // else display invalid username error message
      echo "invalid username";
    }
  }
  // close the connection
  $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./styles/main.css" />
  <meta charset="UTF-8" />
  <script src="https://kit.fontawesome.com/53a095ce36.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Login page</title>
</head>

<body id="loginBody">
  <!-- <div class="flex"> -->
  <h1 id="loginLogo">Backlit Books</h1>
  <main id="LoginMain">
    <form method="post">
      <div id="centerContent">
        <h2 id="loginTitle">Login</h2>
        <div>
          <!-- Input for user to put their username -->
          <label for="username">Username</label>
          <div class="iconInput">
            <span><i class="fa-solid fa-user"></i></span>
            <input id="username" name="username" type="text" class="loginInput" placeholder="Enter your username" />
          </div>
        </div>
        <div>
          <label for="password">Password</label>
          <div class="iconInput">
            <span><i class="fa-solid fa-lock"></i></span>
            <input id="password" name="password" type="password" class="loginInput" placeholder="Enter your password" />
          </div>
        </div>
        <div class="flexed">
          <input id="agree" type="checkbox" name="remember" value="Y" />
          <label for="agree"> Remember Me </label>
          <a id="forgotpwlink">Forgot Password?</a>
        </div>
        <div>
          <button id="loginButton" name="login">Login</button>
        </div>
      </div>
    </form>
  </main>
  <!-- </div> -->
</body>

</html>

<!-- <html lang="en">

	<head>
		<title> Login test v2 </title>
	</head>

	<body>

		<form method = "POST" action="Login.php">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" placeholder="Enter Username" name="username" required></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" placeholder="Enter Password" name="psw" required></td>
				</tr>
			</table>
			<button type="submit" name="login" value="submit" >Login</button>
		</form>

	</body>

</html> -->