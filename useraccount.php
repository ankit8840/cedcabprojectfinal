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
    $password = $_POST['password'];
    $loc=$con->update($id,$name,$mobile,$password);
    header("Refresh:0; url=useraccount.php");
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
      Admin Panel
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
            <td><input id="userid" type="text" value=<?php echo $row['user_id']?> name="userid" size="2"></td>
            <td><input id="username" type="text" value=<?php echo $row['user_name']?> name="username" size="10"></td>
            <td><input type="text" value=<?php echo $row['name']?> name="name1" size="10"></td>
            <td><input type="text" value=<?php echo $row['mobile']?> name="mobile" size="10"></td>
            <td><input type="text" value=<?php echo $row['password']?> name="password" size="5"></td>
            <td><input type="submit" value="UPDATE" name="update"></td>
            <td><input type="submit" value="DELETE" name="delete"></td>
        </tr>
    </form>
     <?php endwhile;?>
     <?php endif;?>
</table>
     </div>
     </body>
<script>
    document.getElementById("userid").readOnly = true; 
    document.getElementById("username").readOnly = true; 
    </script>
    <html>




