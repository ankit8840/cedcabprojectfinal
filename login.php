<?php
GLOBAL $username;
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
    if(isset($_SESSION['booking'])){
        $time=$_SESSION['booking']['time'];
        $logtime=$_SESSION['userdata']['logintime'];
        $totaltime=$logtime-$time;
        if($totaltime>30){
            echo '<script>alert("Your Booking session is expired")</script>';
            unset($_SESSION['booking']);
        }
    }
    
      
    if($login!="Login Failed"){
        if($_SESSION['userdata']['name']=="admin"){
        header("Refresh:0; url=admin/adminpage.php");
        }
        else{
        header("Refresh:0; url=userdashboard.php");
        }
    }
    else{
        echo '<script>alert("Enter valid username or password")</script>';
        header("Refresh:0; url=login.php");
    }
}
if(isset($_POST["remember"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    setcookie($username, $password, time() + (86400 * 30), "/");
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
       <li><a href="index.php">HOME</a></li>
    </ul>
</div>
    <div id="wrapper">
        <div id="login-form">
          <h2>Login</h2>
            <form action="" method="POST">
                <p>
                    <label for="username">Username: 
                    <input type="text" name="username" <?php if(isset($_COOKIE[$username])):?>value=<?php $username ?><?php endif; ?>
                        <?php if(!isset($_COOKIE[$username])):?>value=''<?php endif; ?>>
                    </label>
                </p>
                <p>
                    <label for="password">Password: 
                        <input type="password" name="password" required>
                    </label>
                </p>
                <p>
                    <input type="checkbox" name="remember" id="check"><label>Remember Me</label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Login">
                </p>
                <p class="login">
                    <a href="singup.php">Sign up?</a>
                </p>
            </form>
        </div>
        <!-- <div class="error">
                <?php echo $message ?>
        </div> -->
    </div>
    <?php require 'footer.html'; ?>
</body>
</html>