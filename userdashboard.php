<?php 
require 'class.php';
$conn1 = new Totals();
$id=$_SESSION["userdata"]["userid"];
$name=$_SESSION["userdata"]["name"];
$conn1->connect('localhost', 'root', '', 'newtasks');
$usertotal=$conn1->usertotalride($id);
$pendingride=$conn1->userpendingride($id);
$comride=$conn1->usercomride($id);
$cancleride=$conn1->usercancleride($id);
$name=$_SESSION["userdata"]["name"];
if(isset($_SESSION['booking'])){
    $pickup=$_SESSION['booking']['pickup'];
    $drop=$_SESSION['booking']['drop'];
    $totaldistance=$_SESSION['booking']['distance'];
    $weight=$_SESSION['booking']['luggage'];
    if($weight==""){
        $weight=0;
    }
    $cartype=$_SESSION['booking']['cartype'];
    $fare=$_SESSION['booking']['fare'];
    $status=$_SESSION['booking']['status'];
    $fields = array('pickup', 'droploc', 'total_distance','cartype','luggage','total_fare','status','customer_user_id');
                $data = array($pickup, $drop, $totaldistance,$cartype, $weight, $fare, $status, $id);
        
                $res = $conn1->insert($fields, $data, 'tbl_ride');
                unset($_SESSION['booking']);
                echo '<script>alert("Your ride request is pending wait for Confirmation")</script>';
                echo '<script>window.location.href = "userdashboard.php"</script>';
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
<?php

?>
<div id="tiles">
<div class="tile1"><br>
<a href="index.php"><i class="fa fa-th-large" style="font-size:36px;"></i><br><br>Book New Ride</a></div>
<div class="tile1"><br>
<a  href="userpendingrides.php"><i class="fa fa-automobile" style="font-size:36px;"></i><br><br><span class="count"><?php echo $pendingride?></span><br>Pending Rides</a></div>
<div class="tile1">
<a href="usercomplete.php"><i class="fa fa-address-book" style="font-size:36px"></i><br><br><span class="count"><?php echo $comride?></span><br>Completed Rides</a></div>
<div class="tile1">
<a href="usercanclerides.php"><i class="fa fa-bell" style="font-size:36px"></i><br><br><span class="count"><?php echo $cancleride?></span><br>Cancle Rides</a></div>
<div class="tile1">
<a href="userrides.php"><i class="fa fa-map-marker" style="font-size:36px"></i><br><br><span class="count"><?php echo $usertotal?></span><br>All Rides</div>
<div class="tile1">
<a href="useraccount.php"><i class="fa fa-hourglass-1" style="font-size:36px"></i><br><br><span class="count"></span><br>Account</a></div>
</div>
<div id="addfoot">
        <a><i class="fa fa-facebook-square"></i></a>
        <a><i class="fa fa-twitter-square"></i></a>
        <a><i class="fa fa-instagram"></i></a>
        <div id="copyright">© 2020 Copyright:
            <a href="#">Cedcabs.com</a>
        </div>
</div>
</html>