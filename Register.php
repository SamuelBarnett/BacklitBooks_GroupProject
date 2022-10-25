<!-- This html was just a placeholder in order for me to test that the database connection works  -->
<!-- WHOMEVER IS WORKING ON THE FRONT END NEEDS TO REPLACE THIS -->
<!DOCTYPE html>

<html lang="en">

	<head>
		<title> Register test v4 </title>
	</head>

	<body>

		<form method = "POST" action="Register.php">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" placeholder="Enter Username" name="uname"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" placeholder="Enter Email" name="email" ></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" placeholder="Enter Password" name="psw" required></td>
				</tr>
				<tr>
					<td>FName</td>
					<td><input type="text" placeholder="Enter First name" name="fName"></td>
				</tr>
				<tr>
					<td>LName</td>
					<td><input type="text" placeholder="Enter Last Name" name="lName"></td>
				</tr>
                <th>Address info</th>
                <tr>
                    <td>Street/Unit#</td>
                    <td><input type="text" placeholder="Enter Street#" name="streetNo"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" placeholder="Enter Address" name="addr"></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input type="text" placeholder="Enter city" name="city"></td>
                </tr>
                <tr>
                    <td>Province</td>
                    <td><input type="text" placeholder="Enter Province" name="prov"></td>
                </tr>
                <tr>
                    <td>Postal Code</td>
                    <td><input type="text" placeholder="Postal code" name="pcode"></td>
                </tr>
			</table>
			<button type="submit" name="register" value="submit">Submit</button>
		</form>
        
	</body>

</html>

<?php
    
    require 'DBconnection.php';
    // establish connection
    $pdo = connectDB();

    // If the form is submitting perform the operations in the brackets.
    if (ISSET($_POST['register'])){

        // declare variable and grab by form element name
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['psw'];
        $fname = $_POST['fName'];
        $lname = $_POST['lName'];
        $unitNo = $_POST['streetNo'];
        // if we end up including address info in the database uncomment the next line
        /*
        $addr = $_POST['addr'];
        $city = $_POST['city'];
        $prov = $_POST['prov'];
        $pcode = $_POST['pcode'];
        */

        // hash the password and store it
        $hashedPSW = password_hash($password, PASSWORD_DEFAULT);

        // sql query to insert into the users table
        $sql="INSERT INTO users (Username, psw, email, FName, LName) VALUES (? , ?, ? , ? , ?);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uname, $hashedPSW, $email, $fname, $lname]);
        // redirect to login page
        header("Location:Login.php");

        // close connection
        $pdo = null;
    }
?>