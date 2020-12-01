<?php
require 'class.php';
$con = new User();
$con->connect('localhost', 'root', '', 'newtasks');
$msg = '';
$error = array();
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login=$con->login($username,$password);
    // echo '<script>alert("'.$login.'");</script>';
    if($login!="Login Failed"){
        if($_SESSION['userdata']['name']=="admin"){
        header("Refresh:0; url=adminpage.php");
        }
        else{
        header("Refresh:0; url=userdashboard.php");
        }
    }
    else{
        header("Refresh:0; url=login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>
       Login
    </title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div id="nav1">
    <ul>
        <li><img src="olaimg.png"></li>
        <div id="nav">
            <h1>Welcome To CEDCABS Enjoy Your Ride</h1>
        </div>
    </ul>
</div>
    <div id="wrapper">
        <div id="login-form">
          <h2>Login</h2>
            <form action="" method="POST">
                <p>
                    <label for="username">Username: 
                        <input type="text" name="username" required>
                    </label>
                </p>
                <p>
                    <label for="password">Password: 
                        <input type="password" name="password" required>
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Login">
                </p>
                
            </form>
        </div>
        <!-- <div class="error">
                <?php echo $message ?>
        </div> -->
    </div>
    <div id="margin">
    </div>
</body>
</html>