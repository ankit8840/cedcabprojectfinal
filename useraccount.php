<?php
require 'class.php';
$id=$_SESSION['userdata']['userid'];
$name=$_SESSION['userdata']['name'];
$con = new showuser();
$con->connect('localhost', 'root', '', 'newtasks');
$loc=$con->useraccount($id);
if(isset($_POST['update'])){
    $name=$_POST['name1'];
    $mobile = $_POST['mobile'];
    if(!empty($mobile)){
        if(preg_match('/^[0-9]{10}+$/', $mobile)){
            $mobile=$mobile;
        }
        else{
            echo'<script>alert("please enter valid Mobile Number")</script>';
            header("Refresh:0; url=useraccount.php");
            return;
        }
    }
    $password = $_POST['password'];
    $loc=$con->update($id,$name,$mobile,$password);
    if($loc=="password"){
        echo '<script>alert("Updated")</script>';
        header("Refresh:0; url=useraccount.php");
        }
        if($loc==1){
            header("Refresh:0; url=logout.php");
        }
}
if(isset($_POST['delete'])){
    $loc=$con->delete($id);
    header("Refresh:0; url=index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>
      User Panel
   </title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="nav1">
        <ul>
            <li><img src="olaimg.png"></li>
            <div id="nav2">
                <h1>Welcome <?php echo $name ?></h1>
            </div>
        </ul>
<div id="aside">

<div class="sidenav">
  <a href="userdashboard.php">Home</a>
  <a href="index.php">Book New Ride</a>
  <a href="userpendingrides.php">Pending Rides</a>
  <a href="usercomplete.php">Completed Rides</a>
  <a href="usercanclerides.php">Canceled Rides</a>
  <a href="userrides.php">All Rides</a>
  <a href="useraccount.php">Account</a>
  <a href="logout.php">Logout</a>
</div> 
</div>
<div id="tiles">
    <h1 style="color:white">Account Info</h1>
    <table id="tiletab">
    <tr>
        <td>User Id</td>
        <td>User Name</td>
        <td>Name</td>
        <td>Mobile</td>
        <td>Password</td>
        <td>Action</td>
        <td>Action</td>
    </tr>
    <?php if ($loc->num_rows>0) :?>
     <?php while ($row = $loc->fetch_assoc()) :?>
     <form method="POST">
        <tr>
            <td><?php echo $row['user_id']?><input id="userid" type="text" value=<?php echo $row['user_id']?> name="userid" size="2" hidden></td>
            <td><?php echo $row['user_name']?><input id="username" type="text" value=<?php echo $row['user_name']?> name="username" size="10" hidden></td>
            <td><input type="text"  pattern="[A-Za-z]{1,}" value=<?php echo $row['name']?> name="name1" size="10"></td>
            <td><input type="text" id="mobile" value=<?php echo $row['mobile']?> name="mobile" size="10"></td>
            <td><input type="password" value=<?php echo $row['password']?> name="password" size="5"></td>
            <td><input type="submit" value="UPDATE" name="update"></td>
            <td><input type="submit" onClick="javascript: return confirm('Please confirm deletion');" value="DELETE" name="delete"></td>
        </tr>
    </form>
     <?php endwhile;?>
     <?php endif;?>
</table>
     </div>
     <div id="addfoot">
        <a><i class="fa fa-facebook-square"></i></a>
        <a><i class="fa fa-twitter-square"></i></a>
        <a><i class="fa fa-instagram"></i></a>
        <div id="copyright">© 2020 Copyright:
            <a href="#">Cedcabs.com</a>
        </div>
</div>
     </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.getElementById("userid").readOnly = true; 
    document.getElementById("username").readOnly = true; 
        $(function () {
            
            $("#mobile").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        });

    </script>
<html>




