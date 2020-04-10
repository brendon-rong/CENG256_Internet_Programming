<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/18de49befa.js"></script>
    <script src="script.js"></script>

    <style>
      .error {color:#FF0000;}

      .rectangle {
        height: 570px;
        width: 250px;
        background-color: dimgray;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);
      }

      .button {
        background-color: deepskyblue;
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
      }

      .buttonBlue:hover {
        background-color: white;
        color: deepskyblue;
      }
    </style>
      
    <title>Sign Up</title>
 	</head>

	<body>
		<?php
			//define variables and set to empty values
			 $firstnameErr = $lastnameErr = $emailErr = $phonenumberErr = $usernameErr = $passwordErr = "";
			 $firstname = $lastname = $email = $phonenumber = $username = $password = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				 //FIRST NAME
				 if (empty($_POST["firstname"])) {
					$firstnameErr = "First name is required!";
				  } else {
					$firstname = test_input($_POST["firstname"]);  // clears spaces etc to prep data for testing
					if (!preg_match("/^[a-zA-Z-]{0,19}.$/",$firstname)){ // MAKE SURE IT ONLY CONTAINS LETTERS
						$firstnameErr=" Must contain only letters!";
					}
				  }

				  //LAST NAME
				  if (empty($_POST["lastname"])) {
					$lastnameErr = "Last name is required!";
				  } else {
					$lastname = test_input($_POST["lastname"]); // clears spaces etc to prep data for testing
					if (!preg_match("/^[a-zA-Z]{0,19}.$/",$lastname)){ // MAKE SURE IT ONLY CONTAINS LETTERS
						$lastnameErr=" Must contain only letters!";
					}
				  }

				  //EMAIL
		          if (empty($_POST["email"])) {
		  			$emailErr = "Email is required!";
				  } else {
					$email = test_input($_POST["email"]); // clears spaces etc to prep data for testing
					if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/i",$email)){ // MAKE SURE IT ONLY CONTAINS LETTERS AND _
						$emailErr=" Must contain a valid email address!";
					}
				  }

				  //PHONE NUMBER
				  if (empty($_POST["phonenumber"])) {
					$phonenumberErr = "Phone Number is required!";
				  } else {
					$phonenumber = test_input($_POST["phonenumber"]);  // clears spaces etc to prep data for testing
					if (!preg_match("/^[\d]{9}.$/",$phonenumber)){ // MAKE SURE IT ONLY CONTAINS NUMBERS
						$phonenumberErr=" Must contain only numbers!";
					}
				  }

				  //USERNAME
				  if (empty($_POST["username"])) {
					$usernameErr = "Username is required!";
				  } else {
					$username = test_input($_POST["username"]); // clears spaces etc to prep data for testing
					if (!preg_match("/^[A-Za-z1-9\w]+$/",$username)){ // MAKE SURE IT ONLY CONTAINS LETTERS AND _
						$usernameErr=" Must contain only letters, numbers, and or underscore(s)!";
					}
				  }


				 //PASSWORD
				 if (empty($_POST["password"])) {
					$passwordErr = "Password is required!";
				 }else {
					$password = test_input($_POST["password"]); // clears spaces etc to prep data for testing
					if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{5,100}$/",$password)){ // MAKE SURE IT CONTAINS THE PASSWORDS NEEDS
						$passwordErr=" Must contain atleast 5 (five) characters including 1 (one) number and 1 (one) uppercase letter!";
					}
				 }

   				 //continues to target page if all validation is passed
				 if ($firstnameErr == "" && $lastnameErr == "" && $emailErr == "" && $phonenumberErr == "" && $usernameErr == "" && $passwordErr == ""){
					// check if exists in database
					$dbc=mysqli_connect('localhost','admin','password','whoops')
					or die("Could not Connect!\n");
					$sqlUsername = "SELECT * from login WHERE username ='$username';";
					$resultUsername = mysqli_Query($dbc,$sqlUsername) or die (" Error querying database");
					$checkUsername = mysqli_num_rows($resultUsername);

					$sqlEmail = "SELECT * from customer WHERE email ='$email';";
					$resultEmail = mysqli_Query($dbc,$sqlEmail) or die (" Error querying database");
					$checkEmail = mysqli_num_rows($resultEmail);

					if ($checkUsername > 0){
						$usernameErr = "Username already exists".$checkUsername;
					} else if ($checkEmail > 0){
						$emailErr = "Email already exists".$checkEmail;
					} else { // Username and email do not exist so add to whoops database
						$hashpass = hash('ripemd256',$password);
						$sqlLogin = "INSERT INTO login VALUES(NULL,'$username','$hashpass', 0);";
						$resultLogin = mysqli_Query($dbc,$sqlLogin) or die (" Error querying database");
						$sqlCustomer = "INSERT INTO customer VALUES(NULL,'$firstname','$lastname','$phonenumber','$email');";
						$resultCustomer = mysqli_Query($dbc,$sqlCustomer) or die (" Error querying database");
						mysqli_close();
						header('Location: /project/loginPHP.php');
					}
				 }
			}

		       // clears spaces etc to prep data for testing
			function test_input($data){
				$data=trim($data); // gets rid of extra spaces before and after
				$data=stripslashes($data); //gets rid of any slashes
				$data=htmlspecialchars($data); //converts any symbols such as < and > to special characters
				return $data;
			}
		?>

	    <header>
	      <nav>
	        <div class="responsive_menu_div" onclick="menuButton()">
	          <div id="bar_icon_div">
	            <i class="fas fa-bars"></i>
	          </div>
	        </div>
	        <ul class="nav_ul">
	          <li><a id="logo" href="#">whoops!</a></li>
	          <li><a href="#">Information</a></li>
	          <li><a href="#">About Us</a></li>
	          <li><a href="#">Feedback</a></li>
	          <li id="login_li"><a href="#">Login</a></li>
	        </ul>
	      </nav>
	    </header>

	    <main>
	      <center>
	        <div class="container">
	          <br><br><br>
	        <div class="rectangle">
	          <br>
	          <h2 style="font-family: 'Lato', sans-serif; color: white;"><u>Sign Up</u></h2>
	          <br><br>

			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<label for="firstname" style="font-family: 'Lato', sans-serif; color: white;">First Name</label><br>
				<input type="text" name="firstname" id="firstname" placeholder="First Name" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $firstname;?>"/><br>
				<span class="error">* <?php echo $firstnameErr;?></span><br>

				<label for="lastname" style="font-family: 'Lato', sans-serif; color: white;">Last Name</label><br>
				<input type="text" name="lastname" id="lastname" placeholder="Last Name" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $lastname;?>"/><br>
				<span class="error">* <?php echo $lastnameErr;?></span><br>

				<label for="email" style="font-family: 'Lato', sans-serif; color: white;">Email</label><br>
				<input type="text" name="email" id="email" placeholder="example@example.com" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $email;?>"/><br>
				<span class="error">* <?php echo $emailErr;?></span><br>

				<label for="phonenumber" style="font-family: 'Lato', sans-serif; color: white;">Phone Number</label><br>
				<input type="text" name="phonenumber" id="phonenumber" placeholder="4161237654" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $phonenumber;?>"/><br>
				<span class="error">* <?php echo $phonenumberErr;?></span><br>

				<label for="username" style="font-family: 'Lato', sans-serif; color: white;">Username</label><br>
				<input type="text" name="username" id="username" placeholder="Username" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $username;?>"/><br>
				<span class="error">* <?php echo $usernameErr;?></span><br>

				<label for="password" style="font-family: 'Lato', sans-serif; color: white;">Password</label><br>
				<input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $password;?>"/><br>
				<span class="error">* <?php echo $passwordErr;?></span><br><br>

				<button type="submit" class="button buttonBlue" id="submit_btn" name="submit" value="Submit" style="font-family: 'Lato', sans-serif;"><b>Register</b></button>
			</form>
			
			<br><p style="font-family: 'Lato', sans-serif;">Already have an account?</p>
          	<p style="font-family: 'Lato', sans-serif;">Login over <b><a href="loginPHP.php" style="color: black">here</a></b>!</p>

	      	</center>
	      	<?php
	      	echo $firstname."<br/>";
	      	echo $lastname."<br/>";
	      	echo $email."<br/>";
	      	echo $phonenumber."<br/>";
	      	echo $username."<br/>";
	      	echo $password."<br/>";
	      	?>
	    </main>
	</body>
</html>
