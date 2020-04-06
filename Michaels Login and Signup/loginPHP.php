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
        height: 295px;
        width: 200px;
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
    <title>Login</title>
  </head>

  <body>
    <?php
      //define variables and set to empty values
      $usernameErr = $passwordErr = $loginErr = "";
      $username = $password = "";
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (empty($_POST["username"])) {
            $usernameErr = "Username is required!";
          } else {
            $username = test_input($_POST["username"]);  
          }

          if (empty($_POST["password"])) {
            $passwordErr = "Password is required!";
          } else {
            $password = test_input($_POST["password"]); 
          }

        //continues to target page if all validation is passed
        if ( $usernameErr == "" && $passwordErr == ""){
          // check if exists in database
          $dbc = mysqli_connect('localhost','root','admin','whoops')
          or die("Could not connect!\n");
          $hashpass = hash('ripemd256',$password);
          $sql = "SELECT * from login WHERE username = '$username' AND password = '$hashpass';";
          $result = mysqli_Query($dbc,$sql) or die (" Error querying database");
          $checkLogin = mysqli_num_rows($result);
          $sqlLevel = "SELECT * from login WHERE level = '1';";
          $resultLevel = mysqli_Query($dbc,$sqlLevel) or die (" Error querying database");
          $checkLevel = mysqli_num_rows($resultLevel);

          if ($checkLogin == 0){
            $loginErr="Invalid username or password";
          }else if ($checkLogin != 0 && $checkLevel != 0){ 
            header('Location: /project/homepage.html');     //NORMAL USER LOGIN
          }else if ($checkLogin != 0 && $checkLevel == 0){
            header('Location: /project/addorder.html');     //ADD ORDER PAGE FOR ADMIN
          }
        }
      }

      // clears spaces etc to prep data for testing
      function test_input($data){
        $data = trim($data); // gets rid of extra spaces befor and after
        $data = stripslashes($data); //gets rid of any slashes
        $data = htmlspecialchars($data); //converts any symbols usch as < and > to special characters
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
          <h2 style="font-family: 'Lato', sans-serif; color: white;"><u>Login</u></h2>
          <br><br>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <label for="username" style="font-family: 'Lato', sans-serif; color: white;">Username</label><br>
            <input type="text" name="username" id="username" placeholder="Username" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $username;?>"/><br>
            <span class="error">* <?php echo $usernameErr;?></span><br>

            <label for="password" style="font-family: 'Lato', sans-serif; color: white;">Password</label><br>
            <input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5), 0 0px 20px 0 rgba(0, 0, 0, .5);" value="<?php echo $password;?>"/><br>
            <span class="error">* <?php echo $passwordErr;?></span><br><br>
            <span class="error">* <?php echo $loginErr;?></span><br><br>

            <button name="submit" type="submit" class="button buttonBlue" id="submit_btn" value="Login" style="font-family: 'Lato', sans-serif;"><b>Login</b></button>

          </form>

        </div>
        </div>
      <br><p style="font-family: 'Lato', sans-serif;">Don't have an account?</p>
          <p style="font-family: 'Lato', sans-serif;">Sign up over <b><a href="registerPHP.php" style="color: black">here</a></b>!</p>
      </center>
    </main>

    <footer>
      <!--A copyright in the footer with the student names and id numbers-->
    </footer>
  </body>
</html>