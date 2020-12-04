<?php
require 'class.php';
$con = new Database();
$con->connect('localhost', 'root', '', 'newtasks');
$msg = '';
$error = array();
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    if(!empty($mobile)){
        if(preg_match('/^[0-9]{10}+$/', $mobile) && preg_match('/[a-z\s]/i',$name)){
            $mobile=$mobile;
            $name=$name;
        }
        else{
        echo'<script>alert("please enter valid Data")</script>';
        header("Refresh:0; url=singup.php");
        return;
        }
    }
   

       
    if (sizeof($error) == 0) 
    {
        $fields = array('user_name', 'mobile', 'password', 'name');
        $values = array($username, $mobile, $password, $name);

        $res = $con->insert($fields, $values, 'tbl_user');

        if ($res) 
        {
            echo'<script>alert("Register sucessfull")</script>';
            $error=array('input'=>'form','msg'=>"1 Row inserted");
        }
    }
}

?>


<!DOCTYPE html>
<html>
<head>
   <title>
      Register
   </title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="nav1">
    <ul>
        <li><img src="olaimg.png"></li>
        <li><a href="index.php">Home</a></li>
    </ul>
</div>
    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <h2><?php  ?></h2>
            <form method="POST">
                <p>
                    <label for="username">Username: 
                        <input type="text" name="username" pattern="[a-zA-Z][a-zA-Z0-9-_\.]{1,20}"  required>
                    </label>
                </p>
                <p>
                    <label for="name">Name: 
                        <input type="text" name="name"  pattern="[A-Za-z]{1,}" required>
                    </label>
                </p>
                <p>
                    <label for="password">Password: 
                        <input type="password" name="password" required>
                    </label>
                </p>
                <p>
                    <label for="mobile">Mobile: 
                        <input type="text" name="mobile" id="mobile" required>
                    </label><span id="mss"></span>
                </p>
                <p class="submit">
                     <input type="submit" name="submit" value="Submit">
                </p>
                <p class="login">
                    Already Registered?<a href="login.php">Login Here</a>
                </p>
            </form>
        </div>
        <div class="error">
            
        </div>
    </div>
    <?php require 'footer.html'; ?>
</body>
<script>
$(function () {
    
    $("#mobile").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#mss").html("Digits Only").show().fadeOut("slow");
            return false;
        }
    });
});
</script>
</html>