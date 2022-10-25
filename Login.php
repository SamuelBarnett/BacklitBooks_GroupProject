<!-- This html was just a placeholder in order for me to test that the database connection works  -->
<!-- WHOMEVER IS WORKING ON THE FRONT END NEEDS TO REPLACE THIS -->
<!DOCTYPE html>

<html lang="en">

	<head>
		<title> Login test v2 </title>
	</head>

	<body>

		<form method = "POST" action="Login.php">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" placeholder="Enter Username" name="uname" required></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" placeholder="Enter Password" name="psw" required></td>
				</tr>
			</table>
			<button type="submit" name="login" value="submit" >Login</button>
		</form>

	</body>

</html>

<?php

    require 'DBconnection.php';
    require 'ECommerce.php';
	// create session
	session_start();
	// initialize user ID and user name session objects
	$_SESSION['uID'] = "default";
	$_SESSION['uName'] = "default";
	
    // establish connection
	$pdo = connectDB();

    // If the form is submitting perform the operations in the brackets.
    if(ISSET($_POST['login'])){

        // declare variable and grab by form element name
        $uname = $_POST['uname'];
        $password = $_POST['psw'];

        // sql query to grab user id, name and password by inputed username
        $sql= "SELECT UserID, UserName, psw from users WHERE UserName = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uname]);

        while ($row = $stmt->fetch())
        {    
            
            
            // if user entered username matches the username in the DB
            if($uname == $row['UserName']){
                // if user entered password mathches the hashed password in the DB
                if(password_verify($password, $row['psw'])){
                    // Add username and userID to the session
					$_SESSION['uID'] = $row['UserID'];
					$_SESSION['uName'] = $row['UserName'];
					// redirect the user to the store page
					header("Location:Store.php");
                }else{
                    // else display invalid password error message
                    echo "invalid password";
                }
            }else if($row['UserName'] == null){
                // else display invalid username error message
                echo "invalid username";
            }
            
        }
        // close the connection
        $pdo = null;
    }
?>